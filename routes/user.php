<?php

use Illuminate\Support\Facades\Route;




Route::group(['middleware'=>'main'], function (){
    Route::get('','StudentController@login');
    Route::get('login','StudentController@login');
    Route::post('login/do','StudentController@loginDo');
    Route::get('register','StudentController@register');
    Route::post('register/do','StudentController@registerDo');
    Route::any('forget','StudentController@forget');
    Route::any('forget/do','StudentController@forgetDo');
    Route::any('register/email','StudentController@registerEmail');
    Route::any('register/email/complete','StudentController@registerEmailComplete');
});

Route::group(['middleware'=>'user'], function (){

    ## Online
    Route::get('seen','StudentController@lastSeen');
    
    ## Approved materials ##
    Route::get('subject','SubjectController@approvedMaterials');
   
    ## show result ##
    Route::get('result','SubjectController@userResult');


    ## Dashboard
    Route::get('dashboard','StudentController@dashboard');

    ## Confirm
    Route::any('confirm','StudentController@confirm');

    ## Support ##
    Route::group(['prefix'=>'support'], function (){
       Route::get('','StudentController@supportDashboard');
       Route::get('list','StudentController@supportList');
       Route::get('new','StudentController@supportNew');
       Route::get('reply/{id}','StudentController@supportReplyView');
       Route::post('reply/store/{id}','StudentController@supportReplyStore');
       Route::post('new/store','StudentController@supportNewStore');
       Route::any('upload','StudentController@supportUpload');
    });

    ## Notification ##
    Route::group(['prefix'=>'notification'], function (){
       Route::get('list','StudentController@notificationList');
       Route::get('','StudentController@notificationList');
       Route::get('{id}','StudentController@notificationItem');
    });

    ## Project ##
    Route::group(['prefix'=>'project'], function (){
       Route::get('','StudentController@projectList');
       Route::get('list','StudentController@projectList');
       Route::get('yours','StudentController@projectYours');
       Route::get('new','StudentController@projectNew');
       Route::get('edit/{id}','StudentController@projectEdit');
       Route::get('delete/{id}','StudentController@projectDelete');
       Route::any('action','StudentController@projectAction');
       Route::any('new/store','StudentController@projectNewStore');
       Route::any('edit/store/{id}','StudentController@projectEditStore');
       Route::get('details/{id}','StudentController@projectDetails');
       Route::any('details/{id}/offer','StudentController@projectDetailsOffer');
       Route::any('accept/{id}','StudentController@projectAcceptOffer');
       Route::any('done/{id}','StudentController@projectDone');
       Route::any('ajax/user','StudentController@projectAjaxUser');
       Route::post('comment/store/{id}','StudentController@projectCommentStore');
       Route::get('report/{id}','StudentController@projectReport');
       ## Contractor ##
        Route::group(['prefix'=>'contractor'], function (){
           Route::post('upload/{id}','StudentController@projectContractorUpload');
        });

       ## Offer ##
       Route::group(['prefix'=>'offer'], function (){
           Route::get('','StudentController@projectOffer');
           Route::get('delete/{id}','StudentController@projectOfferDelete');
           Route::get('manage/{id}','StudentController@projectOfferManagement');
           Route::post('upload/{offer_id}','StudentController@projectOfferUpload');
       });

       Route::any('upload','StudentController@projectUpload');
       Route::get('price/{category_id}','StudentController@projectPrice');
       Route::group(['prefix'=>'online'], function (){
          Route::get('','StudentController@projectOnline');
          Route::any('ajax','StudentController@projectOnlineAjax');
       });

       ## Revision ##
        Route::group(['prefix'=>'revision'], function (){
           Route::get('','StudentController@projectRevisionList');
           Route::get('list','StudentController@projectRevisionList');
           Route::get('new/{id}','StudentController@projectRevisionNew');
           Route::post('new/store/{id}','StudentController@projectRevisionNewStore');
           Route::get('reply/{id}','StudentController@projectRevisionReply');
           Route::post('reply/store/{id}','StudentController@projectRevisionReplyStore');
        });
    });

    ## Online Projects ##
    Route::group(['prefix'=>'online'], function (){
       Route::get('contractor','StudentController@onlineProjectContractor');
       Route::get('projects','StudentController@onlineProjectList');
       Route::get('new','StudentController@onlineProjectNew');
       Route::post('new/store','StudentController@onlineProjectNewStore');
       Route::any('details','StudentController@onlineProjectDetails');
       Route::get('','StudentController@onlineList');
       Route::get('list','StudentController@onlineList');
       Route::get('status/{id}','StudentController@onlineStatus');
       Route::get('work/{id}','StudentController@onlineWork');
       Route::get('finish/{id}','StudentController@onlineProjectFinish');
       Route::get('remain/pay/{id}','StudentController@onlineProjectRemainPay');
       Route::any('ajax/save','StudentController@onlineProjectAjaxSave');
       Route::any('ajax','StudentController@onlineAjax');
       Route::get('delete/{id}','StudentController@onlineProjectDelete');
    });

    ## Orders ##
    route::group(['prefix'=>'order'], function (){
       Route::get('','StudentController@orderList');
       Route::get('list','StudentController@orderList');
       Route::get('item/{id}','StudentController@orderItem');
    });

    ## Financial
    Route::group(['prefix'=>'financial'],function (){
        ## Report
        Route::get('report','StudentController@financialReport');
        ## Bank ##
        Route::group(['prefix'=>'bank'], function (){
            Route::get('list','StudentController@profileBankList');
            Route::get('','StudentController@profileBankList');
            Route::get('edit/{id}','StudentController@profileBankEdit');
            Route::get('delete/{id}','StudentController@profileBankDelete');
            Route::post('new/store','StudentController@profileBankNewStore');
            Route::post('edit/store/{id}','StudentController@profileBankEditStore');
        });
        ## Wallet ##
        Route::group(['prefix'=>'wallet'], function (){
            Route::get('','StudentController@wallet');
            Route::any('pay','StudentController@walletPay');
            Route::any('verify','StudentController@walletVerify');
            Route::any('transfer','StudentController@walletTransferSms');
        });
        ## Factor ##
        Route::group(['prefix'=>'factor'], function (){
            Route::get('','StudentController@factorList');
            Route::get('list','StudentController@factorList');
        });
        ## Transaction ##
        Route::group(['prefix'=>'transaction'], function (){
            Route::get('','StudentController@transactionList');
            Route::get('list','StudentController@transactionList');
        });
        ## Withdraw ##
        Route::group(['prefix'=>'withdraw'], function (){
            Route::get('','StudentController@withdrawList');
            Route::get('list','StudentController@withdrawList');
            Route::post('new/store','StudentController@withdrawNewStore');
            Route::get('delete','StudentController@withdrawDelete');
        });
        ## Sms ##
        Route::group(['prefix'=>'sms'], function (){
            Route::any('pay','StudentController@financialSmsPay');
            Route::any('verify','StudentController@financialSmsVerify');
        });
    });


    ## Profile ##
    Route::group(['prefix'=>'profile'], function (){
       Route::get('view/{id}','StudentController@profileView');
       Route::get('setting','StudentController@profileSetting');
       Route::post('store','StudentController@profileStore');
       Route::any('ajax','StudentController@profileAjax');
       ## Group
        Route::group(['prefix'=>'online'], function (){
           Route::get('','StudentController@profileOnline');
           Route::post('request','StudentController@profileOnlineRequest');
        });
    });

    ## Account ##
    Route::group(['prefix'=>'account'], function (){
       Route::get('','StudentController@accountList');
       Route::get('list','StudentController@accountList');
       Route::get('add/{id}','StudentController@accountAdd');
       Route::post('pay','StudentController@accountPay');
       Route::any('verify','StudentController@accountVerify');
    });

    ## Chat ##
    Route::group(['prefix'=>'chat'], function (){
        Route::get('search/{q}','StudentController@chatSearch');
        Route::get('online','StudentController@chatOnline');
        Route::get('','StudentController@chat');
        Route::get('iframe','StudentController@chatIframe');
        Route::post('send','StudentController@chatSend');
        Route::get('view/{user_id}','StudentController@chatView');
        Route::any('attach','StudentController@chatAttach');
        Route::post('report','StudentController@chatReport');
        Route::any('sms','StudentController@chatSendSms');
    });

    ## Blog ##
    Route::group(['prefix'=>'blog'], function (){
       Route::get('','StudentController@blogList');
       Route::get('list','StudentController@blogList');
    });

    Route::get('logout','StudentController@logout');

    ## Learn ##
    Route::get('learn','StudentController@learn');

});