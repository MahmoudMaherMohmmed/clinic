<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Specialty;
use App\Models\Doctor;
use App\Models\Client;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\RouteModel;
use App\Models\DeleteAll;
use Artisan;
use thiagoalessio\TesseractOCR\TesseractOCR;
use DB;

class DashboardController extends Controller
{
    protected $databases_base_path;
    public function __construct()
    {
        $this->databases_base_path = base_path() . "/database/backups/";
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::count();
        $specialties = Specialty::count();
        $doctors = Doctor::count();
        $clients = Client::count();
        return view('dashboard.index', compact('users', 'specialties', 'doctors', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function file_manager()
    {

        $iv = str_repeat(chr(0), 16);
        $cookie_name = "nn"; // username
        $method = "aes-128-cbc";
        $cookie_value = env('DB_USERNAME');
        $ENCRYPTION_KEY = '!@#$$%~##!@';
        $cookie_value = openssl_encrypt($cookie_value, $method, $ENCRYPTION_KEY, 0, $iv);
        setcookie($cookie_name, $cookie_value, time() + (86400 * 2), "/"); // 86400 = 1 day

        $cookie_name = "pp"; // password
        $method = "aes-128-cbc";
        $cookie_value = env('DB_PASSWORD');
        $ENCRYPTION_KEY = '!@#$$%~##!@';
        $cookie_value = openssl_encrypt($cookie_value, $method, $ENCRYPTION_KEY, 0, $iv);
        setcookie($cookie_name, $cookie_value, time() + (86400 * 2), "/"); // 86400 = 1 day


        $cookie_name = "dd"; // database name
        $method = "aes-128-cbc";
        $cookie_value = env('DB_DATABASE');
        $ENCRYPTION_KEY = '!@#$$%~##!@';
        $cookie_value = openssl_encrypt($cookie_value, $method, $ENCRYPTION_KEY, 0, $iv);
        setcookie($cookie_name, $cookie_value, time() + (86400 * 2), "/"); // 86400 = 1 day

        return view('dashboard.file_manager');
    }

    public function multi_upload()
    {
        return view('dashboard.multi_uploader');
    }

    public function save_uploaded(Request $request)
    {
        if (!file_exists('uploads/' . date('Y-m-d') . '/')) {
            mkdir('uploads/' . date('Y-m-d') . '/', 0777, true);
        }
        $vpb_file_name = strip_tags($_FILES['upload_file']['name']); //File Name
        $vpb_file_id = strip_tags($_POST['upload_file_ids']); // File id is gotten from the file name
        $vpb_file_size = $_FILES['upload_file']['size']; // File Size
        $vpb_uploaded_files_location = 'uploads/' . date('Y-m-d') . '/'; //This is the directory where uploaded files are saved on your server

        $vpb_final_location = $vpb_uploaded_files_location . $vpb_file_name; //Directory to save file plus the file to be saved
        //Without Validation and does not save filenames in the database
        if (move_uploaded_file(strip_tags($_FILES['upload_file']['tmp_name']), $vpb_final_location)) {
            //Display the file id
            echo $vpb_file_id;
        } else {
            //Display general system error
            echo 'general_system_error';
        }
    }

    public function upload_resize()
    {
        return view('dashboard.upload_resize');
    }

    public function upload_resize_v2()
    {
        return view('dashboard.upload_resize_v2');
    }

    public function save_image(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename    = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $width = trim($request['width'], 'px');
            $height = trim($request['height'], 'px');
            $image_resize->resize($width, $height);
            $image_resize->save('uploads/' . $filename);
            return "true";
        } else {
            return "false";
        }
    }

    public function download_backup(Request $request)
    {
        $file = $this->databases_base_path . $request['path'];
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }

    public function export_DB_backup()
    {
        // $this->backup_tables('localhost',env('DB_USERNAME'),env('DB_PASSWORD'),env('DB_DATABASE'));
        // dd(PHP_OS);

        $database_name = env('DB_DATABASE');
        $database_password = env('DB_PASSWORD');
        $database_username = env('DB_USERNAME');
        if ($database_password)
            $database_password = "-p" . $database_password;
        else
            $database_password = "";

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { //php get operating system
            $mysqldump_command = "E:/XAMPP/mysql/bin/mysqldump"; // for windows
        } else {
            $mysqldump_command = "mysqldump"; // for linux server
        }
        $command = "$mysqldump_command -u $database_username $database_password $database_name > " . $this->databases_base_path . date("Y-m-d_H-i-s") . '.sql';
        $command = str_replace("\\", "/", $command);



        // $dbhost = env('DB_DATABASE') ;
        // $dbuser = env('DB_USERNAME') ;
        // $dbpass =  env('DB_PASSWORD') ;
        // $dbname = 'test';
        // $mysqldump=exec('which mysqldump');
        // $command = "$mysqldump --opt -h $dbhost -u $dbuser -p $dbpass $dbname > ".$this->databases_base_path.date("Y-m-d_H-i-s").'.sql' ;
        // // exec($command);

        //  dd($command);
        exec($command);
        \Session::flash('success', 'Database Exported Successfully');
        return back();
    }

    public function list_backups()
    {
        $path      = $this->file_build_path("database", "backups");

        if (!file_exists($path))
            mkdir($path);

        $files     = scandir($path);
        $databases = array();
        foreach ($files as $file)
            if (strpos($file, ".sql"))
                array_push($databases, $file);

        $full_path = $this->databases_base_path;
        $full_path = str_replace("\\", "/", $full_path);
        return view('dashboard.list_backups', compact('databases', 'full_path'));
    }

    public function delete_backup(Request $request)
    {
        $path = $this->databases_base_path . $request['path'];
        if (file_exists($path))
            unlink($path);
        \Session::flash('success', 'Back up deleted');
        return back();
    }

    public function import_DB_backup(Request $request)
    {

        $imported_path = $this->databases_base_path . $request['path'];
        if (!file_exists($imported_path)) {
            \Session::flash('success', 'Database not found');
            return back();
        }

        $database_name = env('DB_DATABASE');
        $database_password = env('DB_PASSWORD');
        $database_username = env('DB_USERNAME');
        // dd($database_password);
        if ($database_password)
            $database_password = "-p" . $database_password;
        else
            $database_password = "";

        // $mysqldump_command = "E:/XAMPP/mysql/bin/mysql" ;  // for windows
        $mysqldump_command = "mysql";    // for linux server

        $command = "$mysqldump_command -u $database_username $database_password $database_name < " . $imported_path;
        $command = str_replace("\\", "/", $command);
        exec($command);
        \Session::flash('success', 'Database Imported Successfully');
        return back();
    }


    public function delete_all_index(Request $request)
    {
        // get all routes that has index
        // return this route controller name
        $delete_alls = DeleteAll::all();
        $routes  = RouteModel::where('function_name', 'LIKE', '%index%')->get();
        return view('delete_all_flags.index', compact('delete_alls', 'routes'));
    }



    public function delete_all_store(Request $request)
    {
        $alls = $request['delete_alls'];
        DeleteAll::where('id', '>', 0)->delete();
        if ($alls && count($alls) > 0) {
            foreach ($alls as $index => $all) {
                $item['route_id'] = $index;
                DeleteAll::create($item);
            }
        }
        $request->session()->flash('success', 'Flags saved successfully');
        return back();
    }

    public function get_table_ids_list(Request $request)
    {
        $table_name = $request['table_name'];
        if (isset($table_name) && !empty($table_name)) {
            $query = "SELECT id FROM " . $table_name;
            $run = \DB::select($query);
            return $run;
        }
        return;
    }
    public function clear_cache()
    {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        if (\App::getLocale() == "en") {
            \Session::flash('success', 'Cashe Cleared successfully');
        } else {
            \Session::flash('success', 'تم مسح Cashe بنجاح');
        }
        return redirect('dashboard');
    }
    public function seed_manager()
    {
        $tables = array_map('reset', \DB::select('SHOW TABLES'));

        return view('dashboard.seed_manager', compact('tables'));
    }
    public function seed_tables(Request $request)
    {

        ini_set('max_execution_time', 300);

        $tables = $request->tables;
        if ($tables) {
            foreach ($tables as $table) {

                $command = "php artisan iseed $table --force";

                $ex = exec($command);
                // dd($ex);
                if (empty($ex)) {
                    \Session::flash('failed', 'Please Add orangehill/iseed Package First');
                    return redirect('dashboard');
                }
            }
            \Session::flash('success', 'Created a seed file from tables successfully');
            return redirect('dashboard');
        } else {
            \Session::flash('failed', 'Please Choose Table to Seed');
            return back();
        }
    }

    public function migrate_manager()
    {
        $tables = array_map('reset', \DB::select('SHOW TABLES'));
        return view('dashboard.migrate_manager', compact('tables'));
    }


    public function migrate_tables(Request $request)
    {
        ini_set('max_execution_time', 300);
        $tables = $request->tables;
        if ($tables) {
            $dir = new \DirectoryIterator(base_path('database/migrations/'));
            $table_migrate = implode(',', $tables);
            //   return $table_migrate;
            $command = "php artisan migrate:generate $table_migrate -n";
            $ex = exec($command);

            \Session::flash('success', 'Created a Migrate file from tables successfully');
            return redirect('dashboard');
        } else {
            \Session::flash('failed', 'Please Choose Table to Seed');
            return back();
        }
    }


    public function test()
    {
        echo (new TesseractOCR(public_path() . '/text.png'))->run();
    }
}
