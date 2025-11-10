<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Events\ArticleCreated;
use App\Events\ArticleDeleted;
use App\Models\Activity;

class AuthController extends Controller
{

    // عرض الصفحة الرئيسية
    public function index(){
        $articles=Article::get();
        return view('index' , compact('articles'));
    }

    // عرض صفحة الترحيب
    public function welcome(){
          return view('welcome');
    }

    // عرض صفحة تسجيل الدخول
    public function showLogin()
    {
        return view('auth.login');
    }

    // معالجة تسجيل الدخول
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user=Auth::user();
            if($user->role==='admin'){
            return redirect()->intended('/AdminDashboard');
        }else{
            return redirect()->intended('/index');
        }
        }

        return back()->withErrors([
            'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة',
        ])->withInput($request->except('password'));
    }

    // عرض صفحة إنشاء حساب
    public function showRegister()
    {
        return view('auth.register');
    }

    // معالجة إنشاء حساب
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'الاسم مطلوب',
            'name.max' => 'الاسم يجب أن يكون أقل من 255 حرف',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect('/userDashboard');
    }

    // تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();    
        return redirect('/');
    }

    // عرض لوحة التحكم الخاصة بالمستخدم
    public function userDashboard()
    {
        $count_article=Article::get()->where('user_id', Auth::id())->count();
        return view('userDashboard' , compact('count_article'));
    }

    // عرض المقالات الخاصة بمستخدم واحد
    public function show_userArticle(){
        $article=Article::get()->where('user_id', Auth::id());
        return view('ArticleManage' , compact('article'));
    }

    // عرض لوحة التحكم للادمن
    public function AdminDashboard()
    {
        $count_users=User::get()->count();
        $count=Article::get()->count();
        $article_user=Article::get()->where('user_id', Auth::id())->count();
        $activities = Activity::with('user')->orderBy('created_at', 'desc')->take(5)->get();
        return view('AdminDashboard' ,compact('count','count_users','article_user','activities'));
    }

    //عرض صفحة ادارة مقالة
    public function showArticle()
    {
        $article = Article::with('user')->withCount('comments')->orderBy('created_at', 'desc')->get();
        return view('ArticleManage' , compact('article'));
    }


    //عرض صفحة مقالة مفصلة
    public function showMore($id)
    {
        $article = Article::with('comments.user')->find($id);
        return view('showMore' , compact('article'));
    }
   
    
    //تعديل مقالة
    public function updateArticle(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'Categori' => 'required|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $article = Article::find($id);
    
        if (!$article) {
            return redirect()->back()->withErrors(['msg' => 'المقالة غير موجودة']);
        }
    
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->Categori = $request->input('Categori');

        // تحديث الصورة إذا تم رفع صورة جديدة
        if ($request->hasFile('images')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($article->image && file_exists(public_path('images/' . $article->image))) {
                unlink(public_path('images/' . $article->image));
            }
            
            $image = $request->file('images');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $article->image = $imageName;
        }

        $article->save();
    
        return redirect()->route('auth.editArticle', $id)->with('success', 'تم تحديث المقالة بنجاح');
    }

    // عرض صفحة تعديل مقالة
    public function showUpdatePage($id)
    {
        $article = Article::find($id);
    
        if (!$article) {
            return redirect()->back()->withErrors(['msg' => 'المقالة غير موجودة']);
        }
    
        return view('updateArticle', compact('article'));
    }

    // حذف مقالة
    public function deleteArticle($id)
    {
        $article = Article::find($id);
    
        if (!$article) {
            return redirect()->back()->withErrors(['msg' => 'المقالة غير موجودة']);
        }
        $article->delete();
        event(new ArticleDeleted($article));
        $user=Auth::user();
        if($user->role==='admin'){
        return redirect()->route('auth.article')->with('success', 'تم حذف المقالة بنجاح');
        }else{
            return redirect()->route('auth.userDashboard')->with('success', 'تم حذف المقالة بنجاح');
        }
    }

    // نشر مقالة
    public function postArticle(Request $request)
    {
         $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'nullable|string',
        'Categori' => 'required|string',
        'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
     ]);

      $article= new Article();
      $article->title = $request->input('title');
      $article->content = $request->input('content');
      $article->Categori=$request->input('Categori');
      $article->user_id = Auth::id(); // ربط المقال بالمستخدم الحالي
      
      if ($request->hasFile('images')) {
        $image = $request->file('images'); //
        $imageName = time() . '_' . $image->getClientOriginalName(); //اسم فريد
        $image->move(public_path('images'), $imageName); // حفظ داخل public/images
        $article->image =  $imageName;  // حفظ المسار في قاعدة البيانات
     }
        $article->save();
        event(new ArticleCreated($article));
        return redirect()->back()->with('success', 'تمت إضافة المقال بنجاح!');
    }

    // عرض صفحة نشر المقالة
    public function showPostPage(){
        return view('postArticle');
    }

   

    // عرض صفحة ادارة المستخدمين
    public function showUser()
    {
        $user = User::withCount('articles')->get();
        return view('UserManage' , compact('user'));
    }


    // حذف مستخدم
    public function userDelete($id)
    {
        $currentUser = Auth::user();
    
        if ($currentUser->id == $id) {
            return redirect()->back()->withErrors(['msg' => 'لا يمكنك حذف نفسك']);
        }
    
        $targetUser = User::find($id);
    
        if (!$targetUser) {
            return redirect()->back()->withErrors(['msg' => 'المستخدم غير موجود']);
        }
    
        $targetUser->articles()->delete();
        $targetUser->delete();
    
        if ($currentUser->role === 'admin') {
            return redirect()->back()->with('success', 'تم حذف المستخدم بنجاح');
        } else {
            return redirect()->back()->with('success', 'تم حذف المستخدم بنجاح');
        }
    }

    // ترقيه
    public function star($id)
    {
        $user=User::find($id);
        $user->role = 'admin';
        $user->save();
        return redirect()->back()->with('success', 'تمت الترقيه بنجاح');
    }
    
    // من نحن
    public function whous()
    {
        return view('whoUs');
    }

    // اضافة تعليق
    public function postComment(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'article_id' => 'required|exists:articles,id',
            'user_id' => 'required|exists:users,id',
        ]);
    
        Comment::create([
            'content' => $request->content,
            'article_id' => $request->article_id,
            'user_id' => auth()->id(),
        ]);
    
        return redirect()->back()->with('success', 'تم حفظ التعليق بنجاح');
    
    }

  
    // search input
    public function ArticleSearch(Request $request)
    {
    
       $keyword = $request->input('keyword');

        $articles = Article::when($keyword, function ($query, $keyword) {
         return $query->where(function ($q) use ($keyword) {
            $q->where('title', 'like', "%$keyword%")
              ->orWhere('content', 'like', "%$keyword%");
            });
        })->get();

       return view('index', compact('articles'));
    }

/* - Request $request: يستقبل البيانات من النموذج.
- input('keyword'): يأخذ الكلمة المدخلة من المستخدم.
- when(...): ينفذ البحث فقط إذا كانت الكلمة موجودة.
- where(...): يبحث في العنوان والمحتوى.
- view(...): يعرض النتائج في صفحة articles.index.

*/

}   