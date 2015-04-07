<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use League\Flysystem\Exception;

use App\Http\Controllers\LandriveStorageController;

class DriveController extends Controller {

  private $landriveStorageController;


  public function __construct(){
    $this->landriveStorageController = new LandriveStorageController();

    // Attach MiddleWare //
    $this->middleware('ValidateLanDriveUser');
    $this->middleware('ValidateLanDriveAPIRequest');
    $this->middleware('LanDrivePermissionCheckForRequestedAction');
    // End of Attaching Middleware

  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    return $this->landriveStorageController->getUserDrives();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
      return Input::all();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(){
      $inputs = Input::all();
      if($inputs['create'] == 'file'){
        return $this->landriveStorageController->createFile($inputs);
      }else if($inputs['create'] == 'directory'){
        return $this->landriveStorageController->createDirectory($inputs);
      }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
      $inputs = Input::all();

      $drive = $inputs['drive'];
      $path = isset($inputs['path']) && $inputs['path'] != ''  ? $inputs['path'] : null;
      $download = isset($inputs['download']) && $inputs['download'] == 'y'  ? 'y' : 'n';

      if( $download == 'y' ){
        return $this->landriveStorageController->download($drive,$path);
      }
        return $this->landriveStorageController->getContents($drive,$path);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
    //
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
