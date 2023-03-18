<?php

use App\Models\Option;
use App\Models\student;
use Illuminate\Support\Facades\Cookie;
use Kavenegar\KavenegarApi;
function str_random($count = 16){
    return \Illuminate\Support\Str::random($count);
}
function userLogin($userID, $remember = false){
    $Check = student::find($userID);
    if(!$Check)
        return false;

    if($remember){
        Cookie::queue('User',encrypt($Check->username), 1000000);
    }
    global $User;
    $User = $Check;
    session(['User'=>$Check]);
    return true;

}
function getOption($meta, $default = ''){
    $option =\App\Models\Option::where('meta',$meta)->first();
    if($option && $option->value != '' && $option->value != null)
        return $option->value;
    else
        return $default;
}
function setOption($meta,$value,$mode = null){
   Option::updateOrCreate(
        ['meta'=>$meta],
        ['value'=>$value,'mode'=>$mode]
    );
}
function setOptionAll($array){
    foreach ($array as $meta=>$value) {
       Option::updateOrCreate(
            ['meta' => $meta],
            ['value' => $value]
        );
    }
}
function duplicate_email($email){
    $user = User::where('email',$email)->count();
    if($user > 0)
        return true;
    else
        return false;
}
function duplicate_phone($phone){
    $user = User::where('phone',$phone)->count();
    if($user > 0)
        return true;
    else
        return false;
}
function duplicate_username($username){
    $user = User::where('username',$username)->count();
    if($user > 0)
        return true;
    else
        return false;
}
function getMode($type = 'user', $mode){
    if($type == 'user'){
        switch ($mode){
            case 'active':
                return '<label class="badge badge-success">'.trans('admin.active').'</label>';
                break;
            case 'pendding':
                return '<label class="badge  badge-warning">'.trans('admin.inactive').'</label>';
                break;
            case 'banned':
                return '<label class="badge badge-danger">'.trans('admin.user_banned').'</label>';
                break;
            case 'confirm-email':
                return '<label class="badge badge-warning">'.trans('admin.email_verification').'</label>';
                break;
            case 'confirm-sms':
                return '<label class="badge badge-warning">'.trans('admin.sms_verification').'</label>';
                break;
            case 'auth':
                return '<label class="badge badge-warning">'.trans('admin.waiting').'</label>';
                break;
            case '':
                return '<label class="badge badge-warning">'.trans('admin.waiting').'</label>';
                break;
            case null:
                return '<label class="badge badge-warning">'.trans('admin.waiting').'</label>';
                break;
        }
    }
    if($type == 'ticket'){
        switch ($mode){
            case 'new':
                return '<label class="badge badge-primary">'.trans('admin.new').'</label>';
                break;
            case 'waiting':
                return '<label class="badge badge-warning">'.trans('admin.waiting_for_an_answer').'</label>';
                break;
            case 'answered':
                return '<label class="badge badge-success">'.trans('admin.has_been_answered').'</label>';
                break;
            case 'closed':
                return '<label class="badge badge-danger">'.trans('admin.closed').'</label>';
                break;
            default:
                return '<label class="badge badge-danger">'.trans('admin.lack').'</label>';
        }
    }
    if($type == 'public'){
        switch ($mode){
            case 'draft':
                return '<label class="badge badge-warning">'.trans('admin.draft').'</label>';
                break;
            case 'publish':
                return '<label class="badge badge-success">'.trans('admin.publish').'</label>';
                break;
            default:
                return '<label class="badge badge-danger">'.trans('admin.lack_of_status').'</label>';
        }
    }
    if($type == 'bank'){
        switch ($mode){
            case 'draft':
                return '<label class="badge badge-warning">'.trans('admin.draft').'</label>';
                break;
            case 'publish':
                return '<label class="badge badge-success">'.trans('admin.active').'</label>';
                break;
            case 'reject':
                return '<label class="badge badge-danger">'.trans('admin.inactive').'</label>';
                break;
            case 'inactive':
                return '<label class="badge badge-danger">'.trans('admin.inactive').'</label>';
                break;
            default:
                return '<label class="badge badge-warning">'.trans('admin.draft').'</label>';
        }
    }
    if($type == 'transaction'){
        switch ($mode){
            case 'waiting':
                return '<label class="badge badge-warning">'.trans('admin.waiting_for_payment').'</label>';
                break;
            case 'paid':
                return '<label class="badge badge-success">'.trans('admin.paid').'</label>';
                break;
            default:
                return '<label class="badge badge-danger">'.trans('admin.unpaid').'</label>';
        }
    }
    if($type == 'newsletter'){
        switch ($mode){
            case 'draft':
                return '<label class="badge badge-warning">'.trans('admin.draft').'</label>';
                break;
            case 'send':
                return '<label class="badge badge-success">'.trans('admin.send').'</label>';
                break;
            default:
                return '';
        }
    }
    if($type == 'discount'){
        switch ($mode){
            case 'draft':
                return '<label class="badge badge-warning">'.trans('admin.draft').'</label>';
                break;
            case 'expired':
                return '<label class="badge badge-danger">'.trans('admin.expired').'</label>';
                break;
            case 'limited':
                return '<label class="badge badge-danger">'.trans('admin.check_the_restrictions').'</label>';
                break;
            case 'active':
                return '<label class="badge badge-success">'.trans('admin.active').'</label>';
                break;
            case 'publish':
                return '<label class="badge badge-success">'.trans('admin.publish').'</label>';
                break;
            default:
                return '<label class="badge badge-danger">'.trans('admin.lack_of_status').'</label>';
        }
    }
    if($type == 'order'){
        switch ($mode){
            case 'process':
                return '<label class="badge badge-primary">'.trans('admin.in_process').'</label>';
                break;
            case 'waiting':
                return '<label class="badge badge-danger">'.trans('admin.in_process').'</label>';
                break;
            case 'paid':
                return '<label class="badge badge-primary">'.trans('admin.paid').'</label>';
                break;
            case 'done':
                return '<label class="badge badge-success">'.trans('admin.done').'</label>';
                break;
            case 'reject':
                return '<label class="badge badge-danger">'.trans('admin.reject_the_request').'</label>';
                break;
            default:
                return '<label class="badge badge-danger">'.trans('admin.lack_of_status').'</label>';
        }
    }
    if($type == 'product'){
        switch ($mode){
            case 'draft':
                return '<label class="badge badge-warning">'.trans('admin.in_process').'</label>';
                break;
            case 'publish':
                return '<label class="badge badge-success">'.trans('admin.publish').'</label>';
                break;
            default:
                return '<label class="badge badge-danger">'.trans('admin.lack_of_status').'</label>';
        }
    }
    if($type == 'color'){
        switch ($mode){
            case 'inactive':
                return '<label class="badge badge-warning">'.trans('admin.inactive').'</label>';
                break;
            case 'active':
                return '<label class="badge badge-success">'.trans('admin.active').'</label>';
                break;
            default:
                return '<label class="badge badge-danger">'.trans('admin.lack_of_status').'</label>';
        }
    }
    if($type == 'project'){
        switch ($mode){
            case 'draft':
                return '<label class="badge badge-warning">'.trans('admin.draft').'</label>';
             case 'publish':
                    return '<label class="badge badge-primary">'.trans('admin.publish').'</label>';
           case 'accept':
                        return '<label class="badge badge-primary">'.trans('admin.accepted').'</label>';
          case 'process':
                return '<label class="badge badge-secondary">'.trans('admin.in_process').'</label>';
            case 'done':
                return '<label class="badge badge-success">'.trans('admin.done').'</label>';
            default:
                return '<label class="badge badge-danger">'.trans('admin.lack_of_status').'</label>';
        }
    }
    if($type == 'offer'){
        switch ($mode){
            case 'accept':
                return '<span class="badge badge-success">'.trans('admin.accepted').'</span>';
                break;
                case 'pending':
                    return '<span class="badge badge-danger">'.trans('admin.pending').'</span>';
                    break;
            default:
                return '<span class="badge badge-warning">'.trans('admin.draft').'</span>';
                break;
        }
    }
    if($type == 'withdraw'){
        switch ($mode){
            case 'done':
                return '<span class="badge badge-success">'.trans('admin.done').'</span>';
                break;
            case 'reject':
                return '<span class="badge badge-danger">'.trans('admin.reject_the_request').'</span>';
                break;
            case 'process':
                return '<span class="badge badge-info">'.trans('admin.in_process').'</span>';
                break;
            default:
                return '<span class="badge badge-warning">'.trans('admin.request').'</span>';
                break;
        }
    }
    if($type == 'chat'){
        switch ($mode){
            case 'request':
                return '<span class="badge badge-danger">'.trans('admin.the_report').'</span>';
                break;
            case 'done':
                return '<span class="badge badge-success">'.trans('admin.in_process').'</span>';
                break;
        }
    }
    if($type == 'revision'){
        switch ($mode){
            case 'new':
                return '<label class="badge badge-primary">'.trans('admin.new').'</label>';
                break;
            case 'waiting':
                return '<label class="badge badge-warning">'.trans('admin.waiting_for_an_answer').'</label>';
                break;
            case 'employer':
                return '<label class="badge badge-warning">'.trans('admin.employer_response').'</label>';
                break;
            case 'contractor':
                return '<label class="badge badge-warning">'.trans('admin.executive_moderator').'</label>';
                break;
            case 'supporter':
                return '<label class="badge badge-success">'.trans('admin.supporter').'</label>';
                break;
            case 'done':
                return '<label class="badge badge-info">'.trans('admin.dispute_resolution').'</label>';
                break;
            case 'answered':
                return '<label class="badge badge-success">'.trans('admin.has_been_answered').'</label>';
                break;
            case 'closed':
                return '<label class="badge badge-danger">'.trans('admin.closed').'</label>';
                break;
            default:
                return '<label class="badge badge-danger">'.trans('admin.lack_of_status').'</label>';
        }
    }
}
function listType($type = 'transaction', $mode){
    if($type == 'transaction'){
        switch ($mode){
            case 'plan':
                return trans('admin.buy_a_plan');
                break;
            case 'account':
                return trans('admin.Buy_a_subscription');
                break;
            case 'factor':
                return trans('admin.pay_the_factor');
                break;
            case 'credit':
                return trans('admin.add_credit');
                break;
        }
    }
    if($type == 'newsletter'){
        switch ($mode){
            case 'all':
                return trans('admin.all');
                break;
            case 'user':
                return trans('admin.pay_the_factor');
                break;
            case 'user-active':
                return trans('admin.active_service_users');
                break;
            case 'user-banned':
                return trans('admin.inactive_service_users');
                break;
            case 'manager':
                return trans('admin.Managers');
                break;
        }
    }
    if($type == 'filter'){
        switch ($mode){
            case 'select':
                return trans('admin.select');
                break;
            case 'text':
                return trans('admin.text');
                break;
            case 'checkbox':
                return trans('admin.checkbox');
                break;
            default:
                break;
        }
    }
    if($type == 'document'){
        switch ($mode){
            case 'sms':
                return trans('admin.SMS');
                break;
            case 'wallet':
                return trans('admin.add_credit');
                break;
            case 'factor':
                return trans('admin.pay_the_factor');
                break;
            case 'withdraw':
                return trans('admin.checkout');
                break;
            case 'project':
                return trans('admin.project');
                break;
        }
    }
    if($type == 'chat'){
        switch ($mode){
            case 'request':
                return trans('admin.the_report');
                break;
            case 'done':
                return trans('admin.waiting');
                break;
        }
    }
    if($type == 'notification'){
        if(strpos($mode,'alert') !== false) {
            return trans('admin.internal_notification');
        }
    }
}
function getAccess($access){
    if($access == null || $access == '' || !is_array(json_decode($access, true)))
        return '';

    $access = json_decode($access, true);
    $access = implode(' ٬ ',$access);

    $access = str_replace(
        ['manager','user','support','setting','notification','blog','page','discount','order','transaction','product','link','stat','document','project','chat','revision','withdraw','comment'],
        [trans('admin.Managers'),trans('admin.users'),trans('admin.support'),trans('admin.settings'),trans('admin.notices'),trans('admin.blog'),trans('admin.page'),trans('admin.discount_list'),trans('admin.order'),trans('admin.transactions'),trans('admin.project'),trans('admin.link'),trans('admin.credit_statistics'),trans('admin.documents'),trans('admin.project'),trans('admin.chat'),trans('admin.review'),trans('admin.deposit_request'),trans('admin.comments')],
        $access);
    return $access;
}
function inJson($key, $json = null){
    if($json == null || $json == '' || !is_array(json_decode($json)))
        return false;

    $array = json_decode($json, true);
    if(in_array($key, $array))
        return true;

    return false;
}
function addTimeStampReq(\Illuminate\Http\Request $request){
    $array = $request->all();
    $array['create_at_timestamp'] = time();
    $array['update_at_timestamp'] = time();

    $request->request->add($array);
    return $request;
}
function getJDate($date = null){
    if($date == null)
        return '-';

    $time = strtotime($date);
    if(getOption('site_language') == 'fa')
        return jdate('d F Y | H:i',$time);
    else
        return date('d F Y | H:i',$time);
}
function getJDateSecond($date = null){
    if($date == null)
        return '-';
    $time = strtotime($date);
    if(getOption('site_language') == 'fa')
        return jdate('d F Y | H:i:s',$time);
    else
        return date('d F Y | H:i:s',$time);
}
function getJDateTimestamp($time = null){
    if($time == null)
        return '-';
    if(getOption('site_language') == 'fa')
        return jdate('d F Y | H:i',$time);
    else
        return date('d F Y | H:i',$time);
}
function imageUploader($url = null, $name = null, $value = null, $width = 150, $height = 150, $text = ''){
    if($url == null)
        return 'No url set';
    if(!isset($name) || $name == null || $name == '')
        return 'No name set';
    if($value == '')
        $value = null;

    return view('parts.uploader',[
        'url'       => $url,
        'name'      => $name,
        'value'     => $value,
        'width'     => $width,
        'height'    => $height,
        'text'      => $text
    ]);
}
function fileUploader($url = null, $name = null, $value = null, $type = 'single', $title = null){
    if($url == null)
        return 'No url set';
    if(!isset($name) || $name == null || $name == '')
        return 'No name set';
    if($value == '')
        $value = null;

    return view(env('ADMIN_TEMPLATE').'.parts.file_uploader',[
        'url'       => $url,
        'name'      => $name,
        'value'     => $value,
        'type'      => $type,
        'title'     => $title
    ]);
}
function userUrl($user = null){
    if($user == null)
        return;
    if($user == '')
        return;
    return '<a href="/admin/user/edit/'.$user->id.'">'.$user->name.' ('.$user->username.')</a>';
}
function gateWay($gate = null){
    if($gate == null) return;
    switch ($gate){
        case 'zarinpal':
            return  trans('admin.zarinpal');
            break;
        case 'paypal':
            return trans('admin.paypal');
            break;
        case 'Paypal':
            return trans('admin.paypal');
            break;
        default:
            return trans('admin.unpaid');
    }
}
function getJTimeStamp($type = 'day'){
    if($type == 'day') {
        $startDateTimeStamp = jmktime(0, 0, 0, jdate('m', time()), jdate('d', time()), jdate('Y', time()));
        $expireDateTimeStamp = jmktime(23, 59, 59, jdate('m', time()), jdate('d', time()), jdate('Y', time()));
    }
    if($type == 'month') {
        $startDateTimeStamp = jmktime(0, 0, 0, jdate('m', time()), 0, jdate('Y', time()));
        $expireDateTimeStamp = jmktime(23, 59, 59, jdate('m', time()), jdate('d', time()), jdate('Y', time()));
    }

    return ['first'=>date('Y-m-d H:i:s', $startDateTimeStamp),'last'=>date('Y-m-d H:i:s', $expireDateTimeStamp)];
}
function getDateByNum($day = 0){
    $timeStamp = $day * 86400;
    $Time = time() - $timeStamp;
    if(app()->getLocale() == 'fa')
        return jdate('Y/m/d', $Time);
    else
        return date('Y/m/d', $Time);
}
function userCountByDay($day = 0){
    $timeStamp = $day * 86400;
    $Time = time() - $timeStamp;
    if(app()->getLocale() == 'fa') {
        $startDateTimeStamp = jmktime(0, 0, 0, jdate('m', $Time), jdate('d', $Time), jdate('Y', $Time));
        $expireDateTimeStamp = jmktime(23, 59, 59, jdate('m', $Time), jdate('d', $Time), jdate('Y', $Time));
    }else{
        $startDateTimeStamp = mktime(0, 0, 0, date('m', $Time), date('d', $Time), date('Y', $Time));
        $expireDateTimeStamp = mktime(23, 59, 59, date('m', $Time), date('d', $Time), date('Y', $Time));
    }

    // return \App\Models\doctor::where('create_at_timestamp', '>=', $startDateTimeStamp)->where('create_at_timestamp','<=',$expireDateTimeStamp)->count();
}
function sendAdminNotification($title){
    \App\Model\Notification::create([
        'title' => $title,
        'type'  => 'admin',
        'view'  => 0,
        'sender'=> 'system',
        'mode'  => 'publish'
    ]);
}
function sendSms($phone, $text){
        $message = $text;
        $api = new KavenegarApi(env('KAVENEGAR_APIKEY',''));
        $api->VerifyLookup($phone,$message, null,null,'i-type');
        return true;
}
function sendNotification($notification_id){
    $Notification = \App\Model\Notification::where('type','user')->find($notification_id);
    if(!$Notification)
        return false;
}
function getOrderCountByDay($day = null, $mode = null){
    if($day == null)
        return 0;

    $timeStamp  = $day * 86400;
    $Time       = time() - $timeStamp;
    $startDate  = date('Y-m-d',$Time).' 00:00:00';
    $endDate    = date('Y-m-d',$Time).' 23:59:59';

    if($mode == null) {
        return \App\Model\Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->count();
    }else{
        return \App\Model\Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->where('mode',$mode)->count();
    }
}
function setDocument($userId, $name, $amount, $type = 'add', $project_id = null, $mode = null){
    $Message = \App\Model\DocumentMessage::where('name',$name)->first();
    if($Message){
        $MessageText = $Message->description;
    }else{
        $MessageText = '';
    }
    \App\Model\Document::create([
        'user_id'       => $userId,
        'description'   => $MessageText,
        'amount'        => $amount,
        'type'          => $type,
        'mode'          => $mode,
        'project_id'    => $project_id,
        'name'          => $name
    ]);
}
function getBrands(){
    $list = \App\Model\Category::where('type','brand')->orderBy('sort')->get();
    return $list;
}
function getGroup(){
    $list = \App\Model\Category::where('type','group')->orderBy('sort')->get();
    return $list;
}
function getCategory($type = 'project'){
    $list = \App\Model\Category::with(['childes'])->where('type',$type)->orderBy('sort')->get();
    return $list;
}
function getGallery(){
    $list = \App\Model\Gallery::orderBy('sort')->where('mode','publish')->get();
    return $list;
}
function generateProductFilters($product_id = null){
    $data = [];
    if($product_id == null)
        return $data;

    $filters = \App\Model\ContentFilter::with(['category','filter'])->where('product_id', $product_id)->get();
    foreach ($filters as $filter){
        $data[$filter->category_id]['category'] = $filter->category->toArray();
        $data[$filter->category_id]['items'][]  = $filter->toArray();
    }


    $data = array_values($data);
    return $data;
}
function currency(){
    if(getOption('currency_view','title') == 'title'){
        return getOption('currency_title');
    }else{
        return getOption('currency_sign');
    }
}
function purchaseCode($id){
    $Product = \App\Model\Purchase::find($id);
    if(!$Product)
        return '';
    if($Product->code != null && $Product->code != '')
        return $Product->code;

    $StrCode = \Illuminate\Support\Str::random(10);
    $StrCode = strtoupper($StrCode);
    $Product->update(['code'=>$StrCode]);
    return $StrCode;
}
function productRate($product_id){
    $comments = \App\Model\Comment::where('product_id',$product_id)->where('mode','publish')->get();
    $commentCount = count($comments);
    $commentsRate = $comments->sum('rate');

    if($commentCount == 0)
        return 0;

    if($commentsRate == 0)
        return 0;

    return number_format($commentsRate / $commentCount,1);
}
function productPrice($product_id, $color = null){
    global $User;
    $Product = \App\Model\Product::find($product_id);
    if(!$Product)
        return 0;

    if($color == null) {
        if($Product->color_id != null && is_numeric($Product->color_id)) {
            $Color = \App\Model\Color::find($Product->color_id);
            if($Color)
                $Price = $Color->price;
            if(isset($User)){
                if($User->type == 'b2b'){
                    $Price = $Color->price_b2b;
                }
            }
        }else{
            $Price = $Product->price;
        }
    }
    else{
        $Color = \App\Model\Color::find($color);
        if($Color)
            $Price = $Color->price;

        if(isset($User)){
            if($User->type == 'b2b'){
                $Price = $Color->price_b2b;
            }
        }
    }
    $Discount = \App\Model\Discount::where('product_id', $product_id)->where('mode','publish')->orderBy('id','DESC')->first();
    if($Discount){
        if($Discount->type == 'percent'){
            $Price = $Price - ($Price * ($Discount->percent / 100));
        }
        if($Discount->type == 'amount'){
            $Price = $Price - $Discount->amount;
        }
    }

    return $Price;
}
function offPercent($oldPrice = 0, $newPrice = 0){
    $percent = 0;
    if($oldPrice == 0 || $newPrice == 0)
        return $percent;
    if($oldPrice == $newPrice)
        return $percent;

    $percent = number_format(abs((($oldPrice - $newPrice)*100) /$oldPrice),0);
    return $percent;
}
function getColorTitle($colorId = null){
    if($colorId == null)
        return;

    $Color = \App\Model\Color::find($colorId);
    return $Color->title;
}
function getProductRelation($productId)
{
    $relations = [];
    $Product = \App\Model\Product::find($productId);
    if (!$Product)
        return $relations;

    $tags = $Product->tags;
    if ($tags == '' || $tags == null)
        return $relations;

    $tags = explode(',', $tags);
    foreach ($tags as $tag) {
        $rel = \App\Model\Product::with(['colors','group','brand'])->where('tags', 'LIKE', '%' . $tag . '%')->where('id', '<>', $productId)->where('mode', 'publish')->get()->toArray();
        foreach ($rel as $index=>$r){
            $rel[$index]['group'] = (object)$r['group'];
            $rel[$index]['colors'] = (object)$r['colors'];
            $rel[$index]['brand'] = (object)$r['brand'];
        }
        $relations = array_merge($relations, $rel);
    }

    shuffle($relations);
    array_slice($relations, 0, getOption('relation_count', 5));
    return array_unique($relations, SORT_REGULAR);
}
function employerAmount(){
    $return = [];
    $list = \App\Model\Category::where('type','budget')->where('mode','publish')->get();
    foreach ($list as $item){
        $return[] = ['id'=>$item->id,'title'=>$item->title];
    }
    return $return;
}
function getTextList(){
    $list = \App\Model\Category::where('type','text')->where('mode','publish')->select(['id','title'])->get();
    return $list->toArray();
}
function getLanguageList(){
    $list = \App\Model\Category::where('type','language')->where('mode','publish')->select(['id','title'])->get();
    return $list->toArray();
}
function garageList(){
    $list = \App\Model\User::where('type','garage')->select(['id','name'])->get();
    return $list->toArray();
}
function processTime($day = 0,$hour = 0){
    $string = '';
    if($day > 0){
        $string = $day.' '.trans('admin.day').' ';
    }
    if($hour > 0){
        $string.= $hour.' '.trans('admin.hour').' ';
    }

    return $string;

}
function processTags($tags = null){
    $result = [];
    if($tags != null && $tags != ''){
        $result = explode(',',$tags);
    }

    return $result;
}
function getTags(){
    $tags = \App\Model\Category::where('type','tag')->pluck('title');
    return $tags->toArray();
}
function getSkill(){
    $return = [];
    $list = \App\Model\Category::where('type','skill')->orderBy('id','DESC')->get();
    foreach ($list as $item){
        $return[] = ['id'=>$item->id,'title'=>$item->title];
    }
    return $return;
}
function getUserSkill($id){
    $result = [];
    $User = User::find($id);
    if(!$User)
        return $result;

    if(!is_array(json_decode($User->skill,true)) || $User->skill == null){
        return $result;
    }

    $arr = json_decode($User->skill, true);
    $Skills = \App\Model\Category::whereIn('id', $arr)->get();
    foreach ($Skills as $skill){
        $result[] = ['id'=>$skill->id,'title'=>$skill->title];
    }

    return $result;
}
function checkInJson($key = null, $json = null){
    if($key == null || $json == null)
        return false;
    if($json == '' || $key == '')
        return false;
    if(!is_array(json_decode($json,true)))
        return false;

    $arr = json_decode($json, true);
    if(in_array($key, $arr))
        return true;

    return false;
}
function ago($tm, $lang = 'fa', $ashtml = true) {
    $local = array('style' => array('fa' => 'style="direction:rtl;"',
        'en' => 'style="direction:ltr"'),
        'times' => array(
            'fa' => array('ثانیه', 'دقیقه', 'ساعت', 'روز', 'هفته', 'ماه', 'سال', 'دهه'),
            'ar' => array("الثانية" , "الدقيقة" , "الساعة" , "اليوم" , "الأسبوع" , "الشهر" , "السنة" , "العقد"),
            'en' => array('second', 'minute', 'hour', 'day', 'week', 'month', 'year', 'decade')),
        'ago' => array('fa' => 'پیش', 'en' => 'ago'));
    if (intval($tm) > 0) {
        $cur_tm = time();
        $dif = $cur_tm - $tm;
        $lngh = array(1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600);
        for ($v = sizeof($lngh) - 1; ($v >= 0) && (($no = $dif / $lngh[$v]) <= 1); $v--)
            ; if ($v < 0)
            $v = 0; $_tm = $cur_tm - ($dif % $lngh[$v]);
        $no = floor($no);
        if ($no <> 1 && $lang == 'en')
            $local['times'][$lang][$v] .= 's'; $x = sprintf("%d %s ", $no, $local['times'][$lang][$v]);
        if ($ashtml)
            return " " . $x . ' ' . $local['ago'][$lang] . "";
        else
            return $x . ' ' . $local['ago'][$lang];
    } else {
        return '-';
    }
}
function agoJDate($tm, $lang = 'fa', $ashtml = true) {
    $tm = strtotime($tm);
    $local = array('style' => array('fa' => 'style="direction:rtl;"',
        'en' => 'style="direction:ltr"'),
        'times' => array(
            'fa' => array('ثانیه', 'دقیقه', 'ساعت', 'روز', 'هفته', 'ماه', 'سال', 'دهه'),
            'ar' => array("الثانية" , "الدقيقة" , "الساعة" , "اليوم" , "الأسبوع" , "الشهر" , "السنة" , "العقد"),
            'en' => array('second', 'minute', 'hour', 'day', 'week', 'month', 'year', 'decade')),
        'ago' => array('fa' => 'پیش', 'en' => 'ago'));
    if (intval($tm) > 0) {
        $cur_tm = time();
        $dif = $cur_tm - $tm;
        $lngh = array(1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600);
        for ($v = sizeof($lngh) - 1; ($v >= 0) && (($no = $dif / $lngh[$v]) <= 1); $v--)
            ; if ($v < 0)
            $v = 0; $_tm = $cur_tm - ($dif % $lngh[$v]);
        $no = floor($no);
        if ($no <> 1 && $lang == 'en')
            $local['times'][$lang][$v] .= 's'; $x = sprintf("%d %s ", $no, $local['times'][$lang][$v]);
        if ($ashtml)
            return " " . $x . ' ' . $local['ago'][$lang] . "";
        else
            return $x . ' ' . $local['ago'][$lang];
    } else {
        return '-';
    }
}
function checkOffer($user_id, $project_id){
    $offer = \App\Model\Offer::where('user_id', $user_id)->where('project_id',$project_id)->count();
    if($offer > 0)
        return true;
    else
        return false;
}
function getUserIncomeDay($user_id,$dayAgo){
    $date = jdate('Y-m-d',time() - ($dayAgo * 86400));
    $Amount = \App\Model\Document::where('user_id', $user_id)->where('type','add')->where('created_at_sh',$date)
        ->where(function ($w){
            $w->where('name','project_total_settle')->orWhere('name','online_add');
        })
        ->sum('amount');
    return $Amount;
}
function getChatUsers($chatId){
    $Chat = \App\Model\Chat::find($chatId);
    if(!$Chat)
        return ['text'=>''];

    $sender = User::find($Chat->sender_id);
    $receiver = User::find($Chat->receiver_id);

    if($sender && $receiver)
        return ['text'=>'<a href="/admin/user/edit/'.$sender->id.'">'.$sender->name.'</a>,<a href="/admin/user/edit/'.$receiver->id.'">'.$receiver->name.'</a>'];

    return ['text'=>''];
}
function getUserRank($userId){
    $User = User::find($userId);
    if(!$User || $User->point == 0 || $User->point == null)
        return '-';

    $count = User::where('point','>',$User->point)->count();
    if($count == 0)
        return 1;

    return $count + 1;
}
function getUserProcessCount($userId){
    $count = \App\Model\Project::where('user_id',$userId)->where('mode','process')->count();
    return $count;
}
function getUserAcceptedSkills($userId){
    $list = [];
    $projects = \App\Model\Project::where('mode','done')->where('contractor_id',$userId)->pluck('tags')->toArray();
    foreach ($projects as $project){
        $array = json_decode($project,true);
        if(is_array($array)){
            foreach (array_values($array) as $a){
                $list[] = $a;
            }
        }
    }

    return array_unique(array_values($list));
}
function getProjectProcessTimestamp($projectId){
    $daysTime  = 0;
    $hourTime  = 0;
    $project = \App\Model\Project::find($projectId);
    if($project->day > 0)
        $daysTime = $project->day * 86400;
    if($project->hour > 0)
        $hourTime = $project->hour * 60 * 60;

    return $project->accept_at + $daysTime + $hourTime;
}
function sendGoogleFcm($userId,$title,$text){
    $User = User::find($userId);
    if($User->google_token != null && $User->google_token != '') {
        \App\Model\Fcm::create([
            'title'     => $title,
            'text'      => $text,
            'user_id'   => $userId,
            'token'     => $User->google_token,
            'mode'      => 'waiting'
        ]);
    }
}
function getUserPermissions($userID){
    $User = User::find($userID);
    $Permissions = [];
    $categoryId = getOption('user_default_category');
    if($User->category_id != null){
        $CategoryExist = \App\Model\Category::where('type','user')->find($User->category_id)->count();
        if($CategoryExist) {
            if($User->vip > time()) {
                $categoryId = $User->category_id;
            }
        }
    }

    $CategoryPermissions = \App\Model\Category::find($categoryId);
    if(!$CategoryPermissions){
        $Permissions['status'] = 'error';
        $Permissions['description'] = trans('admin.No_user_categories_have_been_registered');
    }

    $Permissions['status']  = 'success';
    $Permissions['sync']    = false;
    $Permissions['offer']   = false;
    $Permissions['project'] = false;
    $Permissions['chat']    = false;

    $syncProject = \App\Model\Project::where('mode','process')->where('contractor_id',$userID)->count();
    if($CategoryPermissions->offer_synchronic > $syncProject) {
        $Permissions['sync'] = true;
    }

    $offerMonth = \App\Model\Offer::where('user_id', $User->id)->where('created_at_sh','LIKE',jdate('Y-m',time()).'%')->count();
    if($CategoryPermissions->offer_month > $offerMonth){
        $Permissions['offer'] = true;
    }

    $projectMonth = \App\Model\Project::where('user_id', $User->id)->where('created_at_sh','LIKE',jdate('Y-m',time()).'%')->count();
    if($projectMonth < $CategoryPermissions->project_month){
        $Permissions['project'] = true;
    }

    $ContactsCount = \App\Model\Chat::where('sender_id',$User->id)->count();
    if($ContactsCount < $CategoryPermissions->contact){
        $Permissions['chat'] = true;
    }

    return $Permissions;
}
function getDefaultUserCategory(){
    $Category = \App\Model\Category::find(getOption('user_default_category'));
    if($Category)
        return $Category->title;
    else
        return '';
}
function isRtl(){
    if(getOption('site_direction') == 'rtl')
        return true;

    return false;
}
function lng(){
    return app()->getLocale();
}
function sendEmail($email,$code){
    \Illuminate\Support\Facades\Mail::send('mail.confirm',['code'=>$code],function ($mail) use ($email){
        $mail->to($email)->subject(getOption('site_title'))->from('no-reply@'.env('APP_NAME'),env('APP_NAME'));
    });
}
function recentBlogPost($count = 3){
    return \App\Model\Content::where('mode','publish')->where('type','blog')->orderBy('id','DESC')->limit($count)->get();
}
function avatar($file = null,$mode = 'site'){
    if($mode == 'site') {
        if ($file == null)
            return '/assets/user/img/avatar.png';

        if (file_exists(getcwd() . $file))
            return $file;

        return '/assets/user/img/avatar.png';
    }
    if($mode == 'app'){
        if ($file == null)
            return url('/').'/assets/user/img/avatar.png';

        if (file_exists(getcwd() . $file))
            return url('/').$file;

        return url('/').'/assets/user/img/avatar.png';
    }
}
function commission($categoryId = null, $amount = 0){
    if($categoryId == null || $categoryId == 0 || $amount == 0 || $amount == null)
        return $amount;

    $Category = \App\Model\Category::find($categoryId);
    if(!$Category || $Category->commission == null || $Category->commission == 0)
        return $amount;

    $percent = ($Category->commission / 100) * $amount;
    if($percent)
        return round($percent);

    return $amount;
}
function getPercent($amount, $percent){
    return round($amount * ($percent/100));
}
function checkProjectComment($userId, $projectId){
    $count = \App\Model\Comment::where('user_id', $userId)->where('project_id', $projectId)->count();
    if($count)
        return true;

    return false;
}
function smsPrice($str = null){
    if($str == null)
        return 0;

    $len = strlen($str);
    if($len == 0)
        return 0;

    $smsLen = getOption('sms_char_count',32);
    $smsPrice = getOption('sms_price',50);

    return round($len / $smsLen) * $smsPrice;
}
function smsChat($phone, $code){
    $api = new KavenegarApi(env('KAVENEGAR_APIKEY',''));
}
function mb_count_words($string) {
    preg_match_all('/[\pL\pN\pPd]+/u', $string, $matches);
    return count($matches[0]);
}
function getExcerpt($text,$count = 100)
{
    $words_in_text = explode(' ',$text);
    $words_to_return = $count;
    $result = array_slice($words_in_text,0,$words_to_return);
    return implode(" ",$result);
}
function sendNotificationUser($UserID, $type, $data = []){
    $Template   = \App\Model\NotificationSetting::where('type', $type)->first();
    if(!$Template || $Template->mode != 'publish')
        return false;

    $alertText  = $Template->alert;
    $needleArr  = ['[User.Name]','[User.Email]','[Project.Title]','[Ticket.Id]','[Ticket.Title]','[Ticket.Update]','[Transaction.Ref]','[Transaction.Mode]','[Transaction.Type]'];

    if(isset($data['user'])){
        $needleArr = ['[User.Name]','[User.Email]'];
        $replaceArr= [$data['user']->name,$data['user']->email];
        $alertText = str_replace($needleArr,$replaceArr,$alertText);
    }
    if(isset($data['project'])){
        $needleArr = ['[Project.Title]'];
        $replaceArr= [$data['project']->title];
        $alertText = str_replace($needleArr,$replaceArr,$alertText);
    }

    if($Template->alert_enable == 1){
        \App\Model\Notification::create([
            'user_id'       => $UserID,
            'title'         => $alertText,
            'description'   => $alertText,
            'alert'         => $alertText,
            'view'          => 0,
            'sender'        => 'auto',
            'type'          => '["alert"]'
        ]);
    }
}
function getUserOfferMonthRemain($UserId){
    $User = User::find($UserId);
    $Permissions = [];
    $categoryId = getOption('user_default_category');
    if($User->category_id != null){
        $CategoryExist = \App\Model\Category::where('type','user')->find($User->category_id)->count();
        if($CategoryExist) {
            if($User->vip > time()) {
                $categoryId = $User->category_id;
            }
        }
    }

    $CategoryPermissions = \App\Model\Category::find($categoryId);
    $offerMonth = \App\Model\Offer::where('user_id', $User->id)->where('created_at_sh','LIKE',jdate('Y-m',time()).'%')->count();
    if($CategoryPermissions->offer_month > $offerMonth){
        return $CategoryPermissions->offer_month - $offerMonth;
    }

    return 0;
}
function getUserProjectMonthRemain($UserId){
    $User = User::find($UserId);
    $Permissions = [];
    $categoryId = getOption('user_default_category');
    if($User->category_id != null){
        $CategoryExist = \App\Model\Category::where('type','user')->find($User->category_id)->count();
        if($CategoryExist) {
            if($User->vip > time()) {
                $categoryId = $User->category_id;
            }
        }
    }

    $CategoryPermissions = \App\Model\Category::find($categoryId);
    $projectMonth = \App\Model\Project::where('user_id', $User->id)->where('created_at_sh','LIKE',jdate('Y-m',time()).'%')->count();
    if($projectMonth < $CategoryPermissions->project_month){
        return $CategoryPermissions->project_month - $projectMonth;
    }

    return 0;
}
function getUserPledgeAmount($UserId){
    $Projects = \App\Model\Project::where('user_id', $UserId)->where('mode','process')->pluck('id')->toArray();
    $Amount   = \App\Model\Document::whereIn('project_id',$Projects)->where('user_id',$UserId)
        ->where('name','project_deposit_removal')
        ->sum('amount');

    return $Amount;
}
function processFinalOnline($userId,$projectId,$mode,$price){
    if($mode != 'done') {
        $firstPay = \App\Model\Document::where('project_id',$projectId)->where('user_id',$userId)->first();
        if($firstPay)
            return  number_format($firstPay->amount);

        return 0;
    }
    $amount = 0;
    $documents = \App\Model\Document::where('project_id', $projectId)->where('user_id', $userId)->get();

    foreach ($documents as $doc){
        if($doc->type == 'minus')
            $amount += $doc->amount;
        else
            $amount -= $doc->amount;
    }

    return number_format($amount);
}
function getTextCount($str, $count){
    if(strlen($str) < $count)
        return $str;

    return substr($str,0, $count).'...';
}
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
function getCurrency(){
    return 'usd';
}

foreach (glob(__DIR__.'/../plugin/*/*_helper.php') as $file){
    include $file;
}