<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Notification;
use App\Model\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use PubNub\PubNub;
use PubNub\Enums\PNStatusCategory;
use PubNub\Callbacks\SubscribeCallback;
use PubNub\PNConfiguration;
use PubNub\Exceptions\PubNubException;
use Monolog\Handler\ErrorLogHandler;


class PushNotificationController extends Controller
{

  protected $pubnub;
  protected $pnconf;


  public function __construct()
  {
      $this->pnconf = new PNConfiguration();
      $this->pnconf->setSubscribeKey(env('SubscribeKey'));
      $this->pnconf->setPublishKey(env('PublishKey'));
      $this->pnconf->setSecretKey(env('SecretKey'));
      $this->pnconf->setSecure(false);
      $this->pubnub = new PubNub($this->pnconf);
      //$this->pubnub->ssl => true;
  }

	public function index (Request $request)
    {
    	$pageTitle = 'Manage Notification';
        $records = Notification::query()->Where('status',0)->Where('type','Admin');
			if($request->query('search')){

			$records->where('title', 'LIKE', "%{$request->input('search')}%")->Where('type','Admin');
			$records->where('description', 'LIKE', "%{$request->input('search')}%")->Where('type','Admin');
			$records->orWhere('user_email', 'LIKE', "%{$request->input('search')}%")->Where('type','Admin');
			$records->orWhere('user_name', 'LIKE', "%{$request->input('search')}%")->Where('type','Admin');
			}

			$users = $records->Where('status',0)->Where('type','Admin')->paginate(env('PAGINATION_LIMIT'));
			
        return view('admin.notification.index',compact('pageTitle','users','main'));
    }

    public function add()
    {
	$pageTitle = 'Manage Notification';
        return view('admin.notification.add', compact('pageTitle'));
    }

	 public function store(Request $request)
    {
     
		$validator = Validator::make($request->all(), [
          'title'          => 'required|max:10',
          'description'          => 'required|max:200',
         
        ]);
		$msg = [
				'message' => 'Something wents wrong!!!',
				'alert-type' => 'error'
				];
				if($validator->fails()){
					return redirect()->intended(route('admin.pushnotificationAdd'))
					->withErrors($validator)
					->withInput()
					->with($msg);

				}
	        try{ 
			      $notification = new Notification;
			        $notification->title = $request->title;
			         $notification->description = $request->description;
			        $notification->save();
			        $userData=User::all()->toArray();
			        foreach($userData as $value){
			         $notifydata=['pn_gcm'=>['data'=>['text'=>$request->title,'message'=>$request->description]]];
                     $notifydataIos=['pn_apns'=>['data'=>['text'=>$request->title,'message'=>$request->description]]];
			       // $notifydata=['text'=>$request->title,'description'=>$request->content]; 
			       // print_r($value['email']);
			        $result = $this->pubnub->publish()
			              ->channel($value['id'].'notify')
			               //->channel('Notify')
			               ->message($notifydata)
			              ->sync();
			               $result1 = $this->pubnub->publish()
			              ->channel($value['id'].'notify')
			               //->channel('Notify')
			               ->message($notifydataIos)
			              ->sync();
                    }
	                $notification = [
						'message' => 'Notification has been sent successfully!!!',
						'alert-type' => 'success'
					];
	        //return redirect()->route('admin.notification.index')->with($notification);
  
                }catch(\PubNub\Exceptions\PubNubServerException $e) {
      	$notification = [
				'message' => $e->getMessage(),
				'alert-type' => 'error'
				];
      	
         // echo "Error happened while publishing: " . $e->getMessage();
                }
       return redirect()->route('admin.pushnotification')->with($notification);

	
   }
    
	public function Delete(Request $request){

		if($request->ajax()){
             try{


                         Notification::where('id', $request->id)->update(['status'=>1]);
                          $response = array('status'=>1,'msg'=>'Notification has been deleted successfully.');



					}catch(\Exception $e){
						$response = array('status'=>0,'msg'=>'something went wrong');

					}

		}
	 	return response()->json($response);
	}

   
	
}
