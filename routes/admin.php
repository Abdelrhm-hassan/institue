<?php


use Illuminate\Http\Request;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'main'], function (){
    Route::get('','AdminController@login');
    Route::get('login','AdminController@login');
    Route::get('logout','AdminController@logout');
    Route::post('login/do','AdminController@loginDo');
    Route::get('forget','AdminController@forget');
    Route::post('forget/do','AdminController@forgetDo')->name('submitRequestpassword');
    Route::get('RestPassword/{token}','AdminController@forgetpasswordlink')->name('forgetpasswordlink');
    Route::post('newPassword','AdminController@newPassword')->name('newPassword');
});

Route::group(['middleware' => 'admin'], function () {

    Route::get('dashboard','AdminController@dashboard');

    ## FileManager ##
    // Route::group(['prefix'=>'filemanager'], function (){
    //     \UniSharp\LaravelFilemanager\Lfm::routes();
    // });

    ### Purchase
    Route::group(['prefix'=>'purchase'], function () {
        Route::get('','AdminController@purchaseList');
        Route::get('list','AdminController@purchaseList');
    });

    ### offers  ###
    Route::group(['prefix'=>'offer'], function (){

        Route::get('/{id}','AdminController@projectOfferlist');  
        Route::get('/{id}/newest','AdminController@projectOffernewest');  
        Route::get('/','AdminController@filterpricemulti');  
        Route::get('/{id}/lowest','AdminController@projectOfferlowst');  
        Route::get('/{id}/highest','AdminController@projectOfferhigh');  
        Route::get('delete/{id}','AdminController@projectOfferDelete');
        Route::post('accept','AdminController@projectOfferaccept')->name('accept.offer');
    });
    ### Project ###
    Route::group(['prefix'=>'project'], function (){
        Route::get('','AdminController@projectList');
        Route::get('list','AdminController@projectList');
        Route::get('online','AdminController@projectListOnline');
        Route::get('new','AdminController@projectNew');
        
        Route::get('delete/{id}','AdminController@projectDelete');
        Route::get('edit/{id}','AdminController@projectEdit');
        Route::post('new/store','AdminController@projectNewStore');
        Route::post('store','AdminController@projectNewStore');
        Route::post('edit/store/{id}','AdminController@projectEditStore');
        Route::any('action','AdminController@projectAction');
        Route::any('facilities','AdminController@projectFacilitiesAjax');
        ## Category ##
        Route::group(['prefix'=>'category'], function (){
            Route::get('','AdminController@projectCategoryList');
            Route::get('list','AdminController@projectCategoryList');
            Route::get('edit/{id}','AdminController@projectCategoryEdit');
            Route::get('delete/{id}','AdminController@projectCategoryDelete');
            Route::post('new/store','AdminController@projectCategoryNewStore');
            Route::post('store','AdminController@projectCategoryNewStore');
            Route::post('edit/store/{id}','AdminController@projectCategoryEditStore');

            ## Online Category
            Route::group(['prefix'=>'online'], function (){
                Route::get('','AdminController@projectCategoryOnlineList');
                Route::get('edit/{id}','AdminController@projectCategoryOnlineEdit');
                Route::get('delete/{id}','AdminController@projectCategoryOnlineDelete');
                Route::post('new/store','AdminController@projectCategoryOnlineNewStore');
                Route::post('edit/store/{id}','AdminController@projectCategoryOnlineEditStore');
                Route::post('edit/store/{id}','AdminController@projectCategoryOnlineEditsettingStore');
            });
        });
        ## Filter ##
        Route::group(['prefix'=>'filter'], function (){
            Route::get('','AdminController@productFilterList');
            Route::get('list/{id}','AdminController@productFilterList');
            Route::get('new/{id}','AdminController@productFilterNew');
            Route::get('edit/{gid}/{id}','AdminController@productFilterEdit');
            Route::get('delete/{id}','AdminController@productFilterDelete');
            Route::post('new/store/{gid}','AdminController@productFilterNewStore');
            Route::post('store/{gid}','AdminController@productFilterNewStore');
            Route::post('edit/store/{id}','AdminController@productFilterEditStore');
            ## Group
            Route::group(['prefix'=>'group'], function (){
                Route::get('','AdminController@productFilterGroupList');
                Route::get('list','AdminController@productFilterGroupList');
                Route::get('new','AdminController@productFilterGroupNew');
                Route::post('new/store','AdminController@productFilterGroupNewStore');
                Route::post('edit/store/{id}','AdminController@productFilterGroupEditStore');
                Route::get('delete/{id}','AdminController@productFilterGroupDelete');
                Route::get('edit/{id}','AdminController@productFilterGroupEdit');
            });
        });
        ## Budget ##
        Route::group(['prefix'=>'budget'], function (){
           Route::get('','AdminController@projectBudgetList');
           Route::get('list','AdminController@projectBudgetList');
           Route::get('new','AdminController@projectBudgetNew');
           Route::post('new/store','AdminController@projectBudgetNewStore');
           Route::get('delete/{id}','AdminController@projectBudgetDelete');
           Route::get('edit/{id}','AdminController@projectBudgetEdit');
           Route::post('edit/store/{id}','AdminController@projectBudgetEditStore');
        });
        ## Language ##
        Route::group(['prefix'=>'language'], function (){
            Route::get('','AdminController@projectLanguageList');
            Route::get('list','AdminController@projectLanguageList');
            Route::get('new','AdminController@projectLanguagetNew');
            Route::post('new/store','AdminController@projectLanguageNewStore');
            Route::get('delete/{id}','AdminController@projectLanguageDelete');
            Route::get('edit/{id}','AdminController@projectLanguageEdit');
            Route::post('edit/store/{id}','AdminController@projectLanguageEditStore');
        });
        ## Text ##
        Route::group(['prefix'=>'text'], function (){
            Route::get('','AdminController@projectTextList');
            Route::get('list','AdminController@projecTextList');
            Route::get('new','AdminController@projectTextNew');
            Route::post('new/store','AdminController@projectTextNewStore');
            Route::get('delete/{id}','AdminController@projectTextDelete');
            Route::get('edit/{id}','AdminController@projectTextEdit');
            Route::post('edit/store/{id}','AdminController@projectTextEditStore');
        });
        ## Tag ##
        Route::group(['prefix'=>'tag'], function (){
            Route::get('','AdminController@projectTagList');
            Route::get('list','AdminController@projecTagList');
            Route::get('new','AdminController@projectTagNew');
            Route::post('new/store','AdminController@projectTagNewStore');
            Route::get('delete/{id}','AdminController@projectTagDelete');
            Route::get('edit/{id}','AdminController@projectTagEdit');
            Route::post('edit/store/{id}','AdminController@projectTagEditStore');
        });
        ## Price
        Route::group(['prefix'=>'price'], function (){
           Route::get('','AdminController@projectPriceList');
           Route::get('list','AdminController@projectPriceList');
           Route::get('edit/{id}','AdminController@projectPriceEdit');
           Route::get('delete/{id}','AdminController@projectPriceDelete');
           Route::post('new/store','AdminController@projectPriceNewStore');
           Route::post('edit/store/{id}','AdminController@projectPriceEditStore');
        });
        ## Reports
        Route::group(['prefix'=>'report'], function (){
           Route::get('','AdminController@projectReportList');
           Route::get('list','AdminController@projectReportList');
           Route::any('action','AdminController@projectReportAction');
        });
    });

    ### acdimic-years 
    Route::group(['prefix'=>'year'],function (){
        Route::get('list','DoctorController@listYear');
        Route::get('edit/{id}','DoctorController@EditYear');
        Route::get('delete/{id}','DoctorController@DeleteYear');
        Route::post('new/store','DoctorController@storeYear');
        Route::post('edit/store/{id}','DoctorController@updateYear');
    });
    ### class Room 
    Route::group(['prefix'=>'class'],function (){
        Route::get('list','ClassRoomController@listYear');
        Route::get('edit/{id}','ClassRoomController@EditYear');
        Route::get('delete/{id}','ClassRoomController@DeleteYear');
        Route::post('new/store','ClassRoomController@storeYear');
        Route::post('edit/store/{id}','ClassRoomController@updateYear');
    });
    ### Subject 
    Route::group(['prefix'=>'subject'],function (){
        Route::get('list','SubjectController@listYear');
        Route::get('edit/{id}','SubjectController@EditYear');
        Route::get('delete/{id}','SubjectController@DeleteYear');
        Route::post('new/store','SubjectController@storeYear');
        Route::post('edit/store/{id}','SubjectController@updateYear');
    });
      ### Staff 
      Route::group(['prefix'=>'staff'],function (){
        Route::get('list','AdminController@staffList');
        Route::get('edit/{id}','AdminController@staffEdit');
        Route::get('delete/{id}','AdminController@staffDelete');
        Route::get('new','AdminController@staffNew');
        Route::post('new/store','AdminController@staffNewStore');
        Route::post('edit/store/{id}','AdminController@staffEditStore');
        Route::any('action','AdminController@staffAction');
    });

    ### doctors 
    Route::group(['prefix'=>'doctor'],function (){
        Route::get('list','DoctorController@List');
        Route::get('show/{id}','DoctorController@show');
        Route::get('edit/{id}','DoctorController@Edit');
        Route::get('delete/{id}','DoctorController@Delete');
        Route::get('new','DoctorController@create');
        Route::post('new/store','DoctorController@store');
        Route::post('edit/store/{id}','DoctorController@update');
        Route::any('action','DoctorController@Action');
    });
    ### students 
    Route::group(['prefix'=>'student'],function (){
        Route::get('list','StudentController@List');
        Route::get('show/{id}','StudentController@show');
        Route::get('edit/{id}','StudentController@Edit');
        Route::get('delete/{id}','StudentController@Delete');
        Route::get('new','StudentController@create');
        Route::post('new/store','StudentController@store');
        Route::post('edit/store/{id}','StudentController@update');
        Route::any('action','StudentController@Action');
    });
    ### User
    Route::group(['prefix'=>'user'],function (){
        Route::get('list','AdminController@userList');
        Route::get('','AdminController@userList');
        Route::get('edit/{id}','AdminController@userEdit');
        Route::post('edit/store/{id}','AdminController@userEditStore');
        Route::get('delete/{id}','AdminController@userDelete');
        Route::any('action','AdminController@userAction');
        Route::any('login/{id}','AdminController@userLogin');
        Route::any('profile/{id}','AdminController@userProfile');

        ## Skill
        Route::group(['prefix'=>'skill'], function (){
           Route::get('','AdminController@userSkillList');
           Route::get('list','AdminController@userSkillList');
           Route::get('edit/{id}','AdminController@userSkillEdit');
           Route::get('delete/{id}','AdminController@userSkillDelete');
           Route::post('new/store','AdminController@userSkillNewStore');
           Route::post('edit/store/{id}','AdminController@userSkillEditStore');
        });

        ## Group
        Route::group(['prefix'=>'group'], function (){
           Route::get('list','AdminController@userGroupList');
           Route::get('','AdminController@userGroupList');
           Route::get('new','AdminController@userGroupNew');
           Route::get('edit/{id}','AdminController@userGroupEdit');
           Route::get('delete/{id}','AdminController@userGroupDelete');
           Route::post('new/store','AdminController@userGroupNewStore');
           Route::post('edit/store/{id}','AdminController@userGroupEditStore');
        });

        ## Online
        Route::group(['prefix'=>'online'], function (){
            Route::get('','AdminController@userOnlineList');
            Route::any('action','AdminController@userOnlineAction');
        });
    });

    ### Manager
    Route::group(['prefix'=>'manager'],function (){
        Route::get('list','AdminController@managerList');
        Route::get('edit/{id}','AdminController@managerEdit');
        Route::get('delete/{id}','AdminController@managerDelete');
        Route::get('new','AdminController@managerNew');
        Route::post('new/store','AdminController@managerNewStore');
        Route::post('edit/store/{id}','AdminController@managerEditStore');
        Route::any('action','AdminController@managerAction');
    });

    ### Discount ###
    Route::group(['prefix'=>'discount'], function (){
        Route::get('','AdminController@discountList');
        Route::get('list','AdminController@discountList');
        Route::get('new','AdminController@discountNew');
        Route::post('new/store','AdminController@discountNewStore');
        Route::get('edit/{id}','AdminController@discountEdit');
        Route::get('delete/{id}','AdminController@discountDelete');
        Route::post('edit/store/{id}','AdminController@discountEditStore');
    });

    ### Content
    ## Blog
    Route::group(['prefix'=>'blog'], function (){
        # Category
        Route::group(['prefix'=>'category'], function () {
            Route::get('list','AdminController@contentBlogCategoryList');
            Route::get('','AdminController@contentBlogCategoryList');
            Route::get('new','AdminController@contentBlogCategoryNew');
            Route::get('edit/{id}','AdminController@contentBlogCategoryEdit');
            Route::get('delete/{id}','AdminController@contentBlogCategoryDelete');
            Route::post('new/store','AdminController@contentBlogCategoryNewStore');
            Route::post('edit/store/{id}','AdminController@contentBlogCategoryEditStore');
        });
        Route::get('list','AdminController@contentBlogList');
        Route::get('','AdminController@contentBlogList');
        Route::get('new','AdminController@contentBlogNew');
        Route::get('edit/{id}','AdminController@contentBlogEdit');
        Route::get('delete/{id}','AdminController@contentBlogDelete');
        Route::post('new/store','AdminController@contentBlogNewStore');
        Route::post('edit/store/{id}','AdminController@contentBlogEditStore');
    });
    ## Page
    Route::group(['prefix'=>'page'], function (){
        # Category
        Route::group(['prefix'=>'category'], function () {
            Route::get('list','AdminController@contentPageCategoryList');
            Route::get('','AdminController@contentPageCategoryList');
            Route::get('new','AdminController@contentPageCategoryNew');
            Route::get('edit/{id}','AdminController@contentPageCategoryEdit');
            Route::get('delete/{id}','AdminController@contentPageCategoryDelete');
            Route::post('new/store','AdminController@contentPageCategoryNewStore');
            Route::post('edit/store/{id}','AdminController@contentPageCategoryEditStore');
        });
        Route::get('list','AdminController@contentPageList');
        Route::get('','AdminController@contentPageList');
        Route::get('new','AdminController@contentPageNew');
        Route::get('edit/{id}','AdminController@contentPageEdit');
        Route::get('delete/{id}','AdminController@contentPageDelete');
        Route::post('new/store','AdminController@contentPageNewStore');
        Route::post('edit/store/{id}','AdminController@contentPageEditStore');
    });
    ## Comment
    Route::group(['prefix'=>'comment'], function (){
        Route::get('','AdminController@commentList');
        Route::get('list','AdminController@commentList');
        Route::get('action/{id}/{mode}','AdminController@commentAction');
        Route::get('delete/{id}','AdminController@commentDelete');
    });

    ### Support
    Route::group(['prefix'=>'support'],function (){
        Route::get('list','AdminController@supportList');
        Route::get('','AdminController@supportList');
        Route::get('delete/{id}','AdminController@supportDelete');
        Route::get('new','AdminController@supportNew');
        Route::get('edit/{id}','AdminController@supportEdit');
        Route::post('edit/store/{id}','AdminController@supportEditStore');
        Route::any('action','AdminController@supportAction');

        ## Category
        Route::group(['prefix'=>'category'], function () {
            Route::get('list','AdminController@supportCategoryList');
            Route::get('','AdminController@supportCategoryList');
            Route::get('new','AdminController@supportCategoryNew');
            Route::get('edit/{id}','AdminController@supportCategoryEdit');
            Route::get('delete/{id}','AdminController@supportCategoryDelete');
            Route::post('new/store','AdminController@supportCategoryNewStore');
            Route::post('edit/store/{id}','AdminController@supportCategoryEditStore');
        });

        ## Reply
        Route::group(['prefix' => 'reply'], function () {
            Route::get('view/{id}','AdminController@supportReplyView');
            Route::get('{id}','AdminController@supportReplyView');
            Route::post('store/{id}','AdminController@supportReplyStore');
            Route::get('edit/{id}','AdminController@supportReplyEdit');
            Route::post('edit/store/{id}','AdminController@supportReplyEditStore');
        });

        ## Setting
        Route::group(['prefix'=>'setting'], function (){
           Route::get('','AdminController@supportSetting');
           Route::post('store','AdminController@supportSettingStore');
           ## Contact
            Route::group(['prefix'=>'contact'],function (){
               Route::post('new/store','AdminController@supportContactNewStore');
               Route::post('edit/store/{id}','AdminController@supportContactEditStore');
               Route::get('edit/{id}','AdminController@supportContactEdit');
               Route::get('delete/{id}','AdminController@supportContactDelete');
            });
        });

    });

    ### Chat
    Route::group(['prefix'=>'chat'], function (){
       Route::get('setting','AdminController@chatSetting');

       ## Filter ##
        Route::group(['prefix'=>'filter'], function (){
           Route::get('','AdminController@chatFilter');
           Route::post('new/store','AdminController@chatFilterNewStore');
           Route::post('edit/store/{id}','AdminController@chatFilterEditStore');
           Route::get('delete/{id}','AdminController@chatFilterDelete');
           Route::get('edit/{id}','AdminController@chatFilterEdit');
        });

        ## Report ##
        Route::group(['prefix'=>'report'], function (){
           Route::get('list','AdminController@chatReportList');
           Route::get('','AdminController@chatReportList');
           Route::get('view/{id}','AdminController@chatReportView');
           Route::any('action','AdminController@chatReportAction');
        });
    });

    ### Notification
    Route::group(['prefix' => 'notification'], function () {
        Route::get('list','AdminController@notificationList');
        Route::get('new','AdminController@notificationNew');
        Route::post('new/store','AdminController@notificationNewStore');
        Route::get('edit/{id}','AdminController@notificationEdit');
        Route::get('delete/{id}','AdminController@notificationDelete');
        Route::post('edit/store/{id}','AdminController@notificationEditStore');
        Route::group(['prefix'=>'setting'],function (){
            Route::get('list','AdminController@notificationSetting');
            Route::get('','AdminController@notificationSetting');
            Route::get('edit/{id}','AdminController@notificationSettingEdit');
            Route::post('store/{id}','AdminController@notificationSettingStore');
            Route::any('action/{id}','AdminController@notificationSettingAction');
        });
        Route::group(['prefix'=>'admin'],function (){
            Route::get('list','AdminController@notificationAdminList');
            Route::get('view/{id}','AdminController@notificationAdminView');
        });

    });

    ### Newsletter
    Route::group(['prefix'=>'newsletter'], function (){
        Route::get('list','AdminController@newsletterList');
        Route::get('','AdminController@newsletterList');
        Route::get('delete/{id}','AdminController@newsletterDelete');
        Route::get('edit/{id}','AdminController@newsletterEdit');
        Route::get('new','AdminController@newsletterNew');
        Route::post('new/store','AdminController@newsletterNewStore');
        Route::post('store','AdminController@newsletterNewStore');
        Route::post('edit/store/{id}','AdminController@newsletterEditStore');
        Route::any('action','AdminController@newslettreAction');
    });

    ### Plan
    Route::group(['prefix'=>'revision'],function (){
        ## Category ##
        Route::group(['prefix'=>'category'], function (){
            Route::get('','AdminController@revisionCategoryList');
            Route::get('list','AdminController@revisionCategoryList');
            Route::post('new/store','AdminController@revisionCategoryNewStore');
            Route::get('delete/{id}','AdminController@revisionCategoryDelete');
            Route::get('edit/{id}','AdminController@revisionCategoryEdit');
            Route::post('edit/store/{id}','AdminController@revisionCategoryEditStore');
        });


        Route::get('list','AdminController@revisionList');
        Route::get('reply/{id}','AdminController@revisionReply');
        Route::post('reply/store/{id}','AdminController@revisionReplyStore');
        Route::any('action','AdminController@revisionAction');
    });

    ### Transaction
    Route::group(['prefix'=>'transaction'],function (){
        Route::get('','AdminController@transactionList');
        Route::get('list','AdminController@transactionList');
    });

    ### Withdraw
    Route::group(['prefix'=>'withdraw'], function (){
       Route::get('list','AdminController@withdrawList');
       Route::any('action','AdminController@withdrawAction');
       Route::get('delete','AdminController@withdrawDelete');
    });

    ### Document ###
    Route::group(['prefix'=>'document'], function (){
       Route::get('list','AdminController@documentList');
       Route::get('new','AdminController@documentNew');
       Route::post('new/store','AdminController@documentNewStore');
    });

    ### Setting
    Route::group(['prefix'=>'setting'], function (){
        Route::get('main','AdminController@settingMain');

        # Bank
        Route::group(['prefix'=>'bank'], function (){
            Route::get('','AdminController@settingBank');
            Route::post('store','AdminController@settingBankStore');
            Route::get('delete/{id}','AdminController@settingBankDelete');
            Route::get('edit/{id}','AdminController@settingBankEdit');
            Route::post('edit/store/{id}','AdminController@settingBankEditStore');
        });

        # Document
        Route::group(['prefix'=>'document'],function (){
            Route::get('','AdminController@SettingDocumentList');
            Route::get('list','AdminController@SettingDocumentList');
            Route::post('store','AdminController@SettingDocumentStore');
        });

        Route::get('text','AdminController@settingText');
        Route::get('profile','AdminController@settingProfile');
        Route::get('user','AdminController@settingUser');
        Route::get('content','AdminController@settingContent');
        Route::get('index','AdminController@settingIndex');
        Route::get('project','AdminController@settingProject');
        Route::get('firebase','AdminController@settingFirebase');
        Route::any('store','AdminController@settingStore');
        Route::post('password/update','AdminController@settingPasswordUpdate');

        ## Footer
        Route::group(['prefix'=>'footer'], function (){
            Route::get('','AdminController@settingFooter');
            # Link
            Route::group(['prefix'=>'link'], function (){
                Route::get('edit/{id}','AdminController@settingFooterLinkEdit');
                Route::get('delete/{id}','AdminController@settingFooterLinkDelete');
                Route::post('new/store','AdminController@settingFooterLinkNewStore');
                Route::post('edit/store/{id}','AdminController@settingFooterLinkEditStore');
            });
            # Social
            Route::group(['prefix'=>'social'], function (){
                Route::get('edit/{id}','AdminController@settingFooterSocialEdit');
                Route::get('delete/{id}','AdminController@settingFooterSocialDelete');
                Route::post('new/store','AdminController@settingFooterSocialNewStore');
                Route::post('edit/store/{id}','AdminController@settingFooterSocialEditStore');
            });
        });

        ## Header
        Route::group(['prefix'=>'header'], function (){
            Route::get('','AdminController@settingHeader');
            # Menu
            Route::group(['prefix'=>'menu'], function (){
                Route::get('edit/{id}','AdminController@settingHeaderMenuEdit');
                Route::get('delete/{id}','AdminController@settingHeaderMenuDelete');
                Route::post('new/store','AdminController@settingHeaderMenuNewStore');
                Route::post('edit/store/{id}','AdminController@settingHeaderMenuEditStore');
            });
        });

        ## Sms
        Route::group(['prefix'=>'sms'], function (){
           Route::get('','AdminController@settingSmsTemplateList');
           Route::get('list','AdminController@settingSmsTemplateList');
           Route::post('new/store','AdminController@settingSmsTemplateNewStore');
           Route::post('edit/store/{id}','AdminController@settingSmsTemplateEditStore');
           Route::get('delete/{id}','AdminController@settingSmsTemplateDelete');
           Route::get('edit/{id}','AdminController@settingSmsTemplateEdit');
        });


    });

    ### Functions
    Route::group(['prefix' => 'function'], function () {
        Route::any('upload/image','AdminController@uploadImage');
        Route::any('upload/file','AdminController@uploadFile');
    });

    ### Bank
    Route::group(['prefix'=>'bank'], function (){
       Route::get('list','AdminController@bankList');
       Route::get('delete/{id}','AdminController@bankDelete');
       Route::get('reject/{id}','AdminController@bankReject');
       Route::get('accept/{id}','AdminController@bankAccept');
    });


});

