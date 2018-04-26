
window.projectVersion = 'master';

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:App" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App.html">App</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:App_Console" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Console.html">Console</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Console_Kernel" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Console/Kernel.html">Kernel</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:App_Exceptions" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Exceptions.html">Exceptions</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Exceptions_Handler" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Exceptions/Handler.html">Handler</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:App_Http" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Http.html">Http</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:App_Http_Controllers" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Http/Controllers.html">Controllers</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:App_Http_Controllers_Auth" >                    <div style="padding-left:54px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Http/Controllers/Auth.html">Auth</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Http_Controllers_Auth_ForgotPasswordController" >                    <div style="padding-left:80px" class="hd leaf">                        <a href="App/Http/Controllers/Auth/ForgotPasswordController.html">ForgotPasswordController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_Auth_LoginController" >                    <div style="padding-left:80px" class="hd leaf">                        <a href="App/Http/Controllers/Auth/LoginController.html">LoginController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_Auth_RegisterController" >                    <div style="padding-left:80px" class="hd leaf">                        <a href="App/Http/Controllers/Auth/RegisterController.html">RegisterController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_Auth_ResetPasswordController" >                    <div style="padding-left:80px" class="hd leaf">                        <a href="App/Http/Controllers/Auth/ResetPasswordController.html">ResetPasswordController</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:App_Http_Controllers_AdminController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/AdminController.html">AdminController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_ApplicantController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/ApplicantController.html">ApplicantController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_Controller" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/Controller.html">Controller</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_CriteriumController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/CriteriumController.html">CriteriumController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_GuardianController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/GuardianController.html">GuardianController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_HomeController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/HomeController.html">HomeController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_MailController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/MailController.html">MailController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_MatchingController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/MatchingController.html">MatchingController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_PreferenceController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/PreferenceController.html">PreferenceController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_ProgramController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/ProgramController.html">ProgramController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_ProviderController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/ProviderController.html">ProviderController</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:App_Http_Middleware" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Http/Middleware.html">Middleware</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Http_Middleware_EncryptCookies" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Middleware/EncryptCookies.html">EncryptCookies</a>                    </div>                </li>                            <li data-name="class:App_Http_Middleware_RedirectIfAuthenticated" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Middleware/RedirectIfAuthenticated.html">RedirectIfAuthenticated</a>                    </div>                </li>                            <li data-name="class:App_Http_Middleware_TrimStrings" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Middleware/TrimStrings.html">TrimStrings</a>                    </div>                </li>                            <li data-name="class:App_Http_Middleware_TrustProxies" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Middleware/TrustProxies.html">TrustProxies</a>                    </div>                </li>                            <li data-name="class:App_Http_Middleware_VerifyCsrfToken" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Middleware/VerifyCsrfToken.html">VerifyCsrfToken</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:App_Http_Requests" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Http/Requests.html">Requests</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Http_Requests_ApplicantRequest" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Requests/ApplicantRequest.html">ApplicantRequest</a>                    </div>                </li>                            <li data-name="class:App_Http_Requests_ReCaptchataRequest" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Requests/ReCaptchataRequest.html">ReCaptchataRequest</a>                    </div>                </li>                            <li data-name="class:App_Http_Requests_UpdateGuardianRequest" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Requests/UpdateGuardianRequest.html">UpdateGuardianRequest</a>                    </div>                </li>                            <li data-name="class:App_Http_Requests_UpdateProgramRequest" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Requests/UpdateProgramRequest.html">UpdateProgramRequest</a>                    </div>                </li>                            <li data-name="class:App_Http_Requests_UpdateProviderRequest" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Requests/UpdateProviderRequest.html">UpdateProviderRequest</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:App_Http_Kernel" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Http/Kernel.html">Kernel</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:App_Mail" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Mail.html">Mail</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Mail_ApplicantMatchMail" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Mail/ApplicantMatchMail.html">ApplicantMatchMail</a>                    </div>                </li>                            <li data-name="class:App_Mail_GuardianVerifiedMail" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Mail/GuardianVerifiedMail.html">GuardianVerifiedMail</a>                    </div>                </li>                            <li data-name="class:App_Mail_ProgramMatchMail" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Mail/ProgramMatchMail.html">ProgramMatchMail</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:App_Providers" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Providers.html">Providers</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Providers_AppServiceProvider" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Providers/AppServiceProvider.html">AppServiceProvider</a>                    </div>                </li>                            <li data-name="class:App_Providers_AuthServiceProvider" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Providers/AuthServiceProvider.html">AuthServiceProvider</a>                    </div>                </li>                            <li data-name="class:App_Providers_BroadcastServiceProvider" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Providers/BroadcastServiceProvider.html">BroadcastServiceProvider</a>                    </div>                </li>                            <li data-name="class:App_Providers_EventServiceProvider" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Providers/EventServiceProvider.html">EventServiceProvider</a>                    </div>                </li>                            <li data-name="class:App_Providers_RouteServiceProvider" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Providers/RouteServiceProvider.html">RouteServiceProvider</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:App_Traits" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Traits.html">Traits</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Traits_GetPreferences" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Traits/GetPreferences.html">GetPreferences</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:App_Validators" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Validators.html">Validators</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Validators_ReCaptcha" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Validators/ReCaptcha.html">ReCaptcha</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:App_Applicant" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="App/Applicant.html">Applicant</a>                    </div>                </li>                            <li data-name="class:App_Code" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="App/Code.html">Code</a>                    </div>                </li>                            <li data-name="class:App_Criterium" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="App/Criterium.html">Criterium</a>                    </div>                </li>                            <li data-name="class:App_Guardian" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="App/Guardian.html">Guardian</a>                    </div>                </li>                            <li data-name="class:App_Matching" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="App/Matching.html">Matching</a>                    </div>                </li>                            <li data-name="class:App_Preference" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="App/Preference.html">Preference</a>                    </div>                </li>                            <li data-name="class:App_Program" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="App/Program.html">Program</a>                    </div>                </li>                            <li data-name="class:App_Provider" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="App/Provider.html">Provider</a>                    </div>                </li>                            <li data-name="class:App_User" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="App/User.html">User</a>                    </div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "App.html", "name": "App", "doc": "Namespace App"},{"type": "Namespace", "link": "App/Console.html", "name": "App\\Console", "doc": "Namespace App\\Console"},{"type": "Namespace", "link": "App/Exceptions.html", "name": "App\\Exceptions", "doc": "Namespace App\\Exceptions"},{"type": "Namespace", "link": "App/Http.html", "name": "App\\Http", "doc": "Namespace App\\Http"},{"type": "Namespace", "link": "App/Http/Controllers.html", "name": "App\\Http\\Controllers", "doc": "Namespace App\\Http\\Controllers"},{"type": "Namespace", "link": "App/Http/Controllers/Auth.html", "name": "App\\Http\\Controllers\\Auth", "doc": "Namespace App\\Http\\Controllers\\Auth"},{"type": "Namespace", "link": "App/Http/Middleware.html", "name": "App\\Http\\Middleware", "doc": "Namespace App\\Http\\Middleware"},{"type": "Namespace", "link": "App/Http/Requests.html", "name": "App\\Http\\Requests", "doc": "Namespace App\\Http\\Requests"},{"type": "Namespace", "link": "App/Mail.html", "name": "App\\Mail", "doc": "Namespace App\\Mail"},{"type": "Namespace", "link": "App/Providers.html", "name": "App\\Providers", "doc": "Namespace App\\Providers"},{"type": "Namespace", "link": "App/Traits.html", "name": "App\\Traits", "doc": "Namespace App\\Traits"},{"type": "Namespace", "link": "App/Validators.html", "name": "App\\Validators", "doc": "Namespace App\\Validators"},
            
            {"type": "Class", "fromName": "App", "fromLink": "App.html", "link": "App/Applicant.html", "name": "App\\Applicant", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Applicant", "fromLink": "App/Applicant.html", "link": "App/Applicant.html#method_getAppliantsByGid", "name": "App\\Applicant::getAppliantsByGid", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Applicant", "fromLink": "App/Applicant.html", "link": "App/Applicant.html#method_getGuardianIdByApplicant", "name": "App\\Applicant::getGuardianIdByApplicant", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Applicant", "fromLink": "App/Applicant.html", "link": "App/Applicant.html#method_getAll", "name": "App\\Applicant::getAll", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App", "fromLink": "App.html", "link": "App/Code.html", "name": "App\\Code", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Console", "fromLink": "App/Console.html", "link": "App/Console/Kernel.html", "name": "App\\Console\\Kernel", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Console\\Kernel", "fromLink": "App/Console/Kernel.html", "link": "App/Console/Kernel.html#method_schedule", "name": "App\\Console\\Kernel::schedule", "doc": "&quot;Define the application&#039;s command schedule.&quot;"},
                    {"type": "Method", "fromName": "App\\Console\\Kernel", "fromLink": "App/Console/Kernel.html", "link": "App/Console/Kernel.html#method_commands", "name": "App\\Console\\Kernel::commands", "doc": "&quot;Register the commands for the application.&quot;"},
            
            {"type": "Class", "fromName": "App", "fromLink": "App.html", "link": "App/Criterium.html", "name": "App\\Criterium", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Exceptions", "fromLink": "App/Exceptions.html", "link": "App/Exceptions/Handler.html", "name": "App\\Exceptions\\Handler", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Exceptions\\Handler", "fromLink": "App/Exceptions/Handler.html", "link": "App/Exceptions/Handler.html#method_report", "name": "App\\Exceptions\\Handler::report", "doc": "&quot;Report or log an exception.&quot;"},
                    {"type": "Method", "fromName": "App\\Exceptions\\Handler", "fromLink": "App/Exceptions/Handler.html", "link": "App/Exceptions/Handler.html#method_render", "name": "App\\Exceptions\\Handler::render", "doc": "&quot;Render an exception into an HTTP response.&quot;"},
            
            {"type": "Class", "fromName": "App", "fromLink": "App.html", "link": "App/Guardian.html", "name": "App\\Guardian", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Guardian", "fromLink": "App/Guardian.html", "link": "App/Guardian.html#method_getGuardianByUid", "name": "App\\Guardian::getGuardianByUid", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/AdminController.html", "name": "App\\Http\\Controllers\\AdminController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\AdminController", "fromLink": "App/Http/Controllers/AdminController.html", "link": "App/Http/Controllers/AdminController.html#method_index", "name": "App\\Http\\Controllers\\AdminController::index", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/ApplicantController.html", "name": "App\\Http\\Controllers\\ApplicantController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\ApplicantController", "fromLink": "App/Http/Controllers/ApplicantController.html", "link": "App/Http/Controllers/ApplicantController.html#method_index", "name": "App\\Http\\Controllers\\ApplicantController::index", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ApplicantController", "fromLink": "App/Http/Controllers/ApplicantController.html", "link": "App/Http/Controllers/ApplicantController.html#method_add", "name": "App\\Http\\Controllers\\ApplicantController::add", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ApplicantController", "fromLink": "App/Http/Controllers/ApplicantController.html", "link": "App/Http/Controllers/ApplicantController.html#method_create", "name": "App\\Http\\Controllers\\ApplicantController::create", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ApplicantController", "fromLink": "App/Http/Controllers/ApplicantController.html", "link": "App/Http/Controllers/ApplicantController.html#method_store", "name": "App\\Http\\Controllers\\ApplicantController::store", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ApplicantController", "fromLink": "App/Http/Controllers/ApplicantController.html", "link": "App/Http/Controllers/ApplicantController.html#method_show", "name": "App\\Http\\Controllers\\ApplicantController::show", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ApplicantController", "fromLink": "App/Http/Controllers/ApplicantController.html", "link": "App/Http/Controllers/ApplicantController.html#method_all", "name": "App\\Http\\Controllers\\ApplicantController::all", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ApplicantController", "fromLink": "App/Http/Controllers/ApplicantController.html", "link": "App/Http/Controllers/ApplicantController.html#method_edit", "name": "App\\Http\\Controllers\\ApplicantController::edit", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ApplicantController", "fromLink": "App/Http/Controllers/ApplicantController.html", "link": "App/Http/Controllers/ApplicantController.html#method_delete", "name": "App\\Http\\Controllers\\ApplicantController::delete", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ApplicantController", "fromLink": "App/Http/Controllers/ApplicantController.html", "link": "App/Http/Controllers/ApplicantController.html#method_update", "name": "App\\Http\\Controllers\\ApplicantController::update", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ApplicantController", "fromLink": "App/Http/Controllers/ApplicantController.html", "link": "App/Http/Controllers/ApplicantController.html#method_setFinalMatch", "name": "App\\Http\\Controllers\\ApplicantController::setFinalMatch", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ApplicantController", "fromLink": "App/Http/Controllers/ApplicantController.html", "link": "App/Http/Controllers/ApplicantController.html#method_setValid", "name": "App\\Http\\Controllers\\ApplicantController::setValid", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ApplicantController", "fromLink": "App/Http/Controllers/ApplicantController.html", "link": "App/Http/Controllers/ApplicantController.html#method_setPriority", "name": "App\\Http\\Controllers\\ApplicantController::setPriority", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers\\Auth", "fromLink": "App/Http/Controllers/Auth.html", "link": "App/Http/Controllers/Auth/ForgotPasswordController.html", "name": "App\\Http\\Controllers\\Auth\\ForgotPasswordController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\ForgotPasswordController", "fromLink": "App/Http/Controllers/Auth/ForgotPasswordController.html", "link": "App/Http/Controllers/Auth/ForgotPasswordController.html#method___construct", "name": "App\\Http\\Controllers\\Auth\\ForgotPasswordController::__construct", "doc": "&quot;Create a new controller instance.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers\\Auth", "fromLink": "App/Http/Controllers/Auth.html", "link": "App/Http/Controllers/Auth/LoginController.html", "name": "App\\Http\\Controllers\\Auth\\LoginController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\LoginController", "fromLink": "App/Http/Controllers/Auth/LoginController.html", "link": "App/Http/Controllers/Auth/LoginController.html#method___construct", "name": "App\\Http\\Controllers\\Auth\\LoginController::__construct", "doc": "&quot;Create a new controller instance.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers\\Auth", "fromLink": "App/Http/Controllers/Auth.html", "link": "App/Http/Controllers/Auth/RegisterController.html", "name": "App\\Http\\Controllers\\Auth\\RegisterController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\RegisterController", "fromLink": "App/Http/Controllers/Auth/RegisterController.html", "link": "App/Http/Controllers/Auth/RegisterController.html#method___construct", "name": "App\\Http\\Controllers\\Auth\\RegisterController::__construct", "doc": "&quot;Create a new controller instance.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\RegisterController", "fromLink": "App/Http/Controllers/Auth/RegisterController.html", "link": "App/Http/Controllers/Auth/RegisterController.html#method_validator", "name": "App\\Http\\Controllers\\Auth\\RegisterController::validator", "doc": "&quot;Get a validator for an incoming registration request.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\RegisterController", "fromLink": "App/Http/Controllers/Auth/RegisterController.html", "link": "App/Http/Controllers/Auth/RegisterController.html#method_create", "name": "App\\Http\\Controllers\\Auth\\RegisterController::create", "doc": "&quot;Create a new user instance after a valid registration.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\RegisterController", "fromLink": "App/Http/Controllers/Auth/RegisterController.html", "link": "App/Http/Controllers/Auth/RegisterController.html#method_store", "name": "App\\Http\\Controllers\\Auth\\RegisterController::store", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\RegisterController", "fromLink": "App/Http/Controllers/Auth/RegisterController.html", "link": "App/Http/Controllers/Auth/RegisterController.html#method_generateStrongPassword", "name": "App\\Http\\Controllers\\Auth\\RegisterController::generateStrongPassword", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers\\Auth", "fromLink": "App/Http/Controllers/Auth.html", "link": "App/Http/Controllers/Auth/ResetPasswordController.html", "name": "App\\Http\\Controllers\\Auth\\ResetPasswordController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\ResetPasswordController", "fromLink": "App/Http/Controllers/Auth/ResetPasswordController.html", "link": "App/Http/Controllers/Auth/ResetPasswordController.html#method___construct", "name": "App\\Http\\Controllers\\Auth\\ResetPasswordController::__construct", "doc": "&quot;Create a new controller instance.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/Controller.html", "name": "App\\Http\\Controllers\\Controller", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/CriteriumController.html", "name": "App\\Http\\Controllers\\CriteriumController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\CriteriumController", "fromLink": "App/Http/Controllers/CriteriumController.html", "link": "App/Http/Controllers/CriteriumController.html#method___construct", "name": "App\\Http\\Controllers\\CriteriumController::__construct", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\CriteriumController", "fromLink": "App/Http/Controllers/CriteriumController.html", "link": "App/Http/Controllers/CriteriumController.html#method_show", "name": "App\\Http\\Controllers\\CriteriumController::show", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\CriteriumController", "fromLink": "App/Http/Controllers/CriteriumController.html", "link": "App/Http/Controllers/CriteriumController.html#method_showByProgram", "name": "App\\Http\\Controllers\\CriteriumController::showByProgram", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\CriteriumController", "fromLink": "App/Http/Controllers/CriteriumController.html", "link": "App/Http/Controllers/CriteriumController.html#method_editAjax", "name": "App\\Http\\Controllers\\CriteriumController::editAjax", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\CriteriumController", "fromLink": "App/Http/Controllers/CriteriumController.html", "link": "App/Http/Controllers/CriteriumController.html#method_store", "name": "App\\Http\\Controllers\\CriteriumController::store", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\CriteriumController", "fromLink": "App/Http/Controllers/CriteriumController.html", "link": "App/Http/Controllers/CriteriumController.html#method_edit", "name": "App\\Http\\Controllers\\CriteriumController::edit", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/GuardianController.html", "name": "App\\Http\\Controllers\\GuardianController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\GuardianController", "fromLink": "App/Http/Controllers/GuardianController.html", "link": "App/Http/Controllers/GuardianController.html#method_store", "name": "App\\Http\\Controllers\\GuardianController::store", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\GuardianController", "fromLink": "App/Http/Controllers/GuardianController.html", "link": "App/Http/Controllers/GuardianController.html#method_show", "name": "App\\Http\\Controllers\\GuardianController::show", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\GuardianController", "fromLink": "App/Http/Controllers/GuardianController.html", "link": "App/Http/Controllers/GuardianController.html#method_edit", "name": "App\\Http\\Controllers\\GuardianController::edit", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\GuardianController", "fromLink": "App/Http/Controllers/GuardianController.html", "link": "App/Http/Controllers/GuardianController.html#method_update", "name": "App\\Http\\Controllers\\GuardianController::update", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\GuardianController", "fromLink": "App/Http/Controllers/GuardianController.html", "link": "App/Http/Controllers/GuardianController.html#method_all", "name": "App\\Http\\Controllers\\GuardianController::all", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\GuardianController", "fromLink": "App/Http/Controllers/GuardianController.html", "link": "App/Http/Controllers/GuardianController.html#method_verify", "name": "App\\Http\\Controllers\\GuardianController::verify", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\GuardianController", "fromLink": "App/Http/Controllers/GuardianController.html", "link": "App/Http/Controllers/GuardianController.html#method_validator", "name": "App\\Http\\Controllers\\GuardianController::validator", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/HomeController.html", "name": "App\\Http\\Controllers\\HomeController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\HomeController", "fromLink": "App/Http/Controllers/HomeController.html", "link": "App/Http/Controllers/HomeController.html#method___construct", "name": "App\\Http\\Controllers\\HomeController::__construct", "doc": "&quot;Create a new controller instance.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\HomeController", "fromLink": "App/Http/Controllers/HomeController.html", "link": "App/Http/Controllers/HomeController.html#method_index", "name": "App\\Http\\Controllers\\HomeController::index", "doc": "&quot;Show the application dashboard.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/MailController.html", "name": "App\\Http\\Controllers\\MailController", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/MatchingController.html", "name": "App\\Http\\Controllers\\MatchingController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\MatchingController", "fromLink": "App/Http/Controllers/MatchingController.html", "link": "App/Http/Controllers/MatchingController.html#method_store", "name": "App\\Http\\Controllers\\MatchingController::store", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\MatchingController", "fromLink": "App/Http/Controllers/MatchingController.html", "link": "App/Http/Controllers/MatchingController.html#method_all", "name": "App\\Http\\Controllers\\MatchingController::all", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\MatchingController", "fromLink": "App/Http/Controllers/MatchingController.html", "link": "App/Http/Controllers/MatchingController.html#method_findMatchings", "name": "App\\Http\\Controllers\\MatchingController::findMatchings", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\MatchingController", "fromLink": "App/Http/Controllers/MatchingController.html", "link": "App/Http/Controllers/MatchingController.html#method_prepareMatching", "name": "App\\Http\\Controllers\\MatchingController::prepareMatching", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\MatchingController", "fromLink": "App/Http/Controllers/MatchingController.html", "link": "App/Http/Controllers/MatchingController.html#method_sendMailsAllMatches", "name": "App\\Http\\Controllers\\MatchingController::sendMailsAllMatches", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/PreferenceController.html", "name": "App\\Http\\Controllers\\PreferenceController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\PreferenceController", "fromLink": "App/Http/Controllers/PreferenceController.html", "link": "App/Http/Controllers/PreferenceController.html#method_show", "name": "App\\Http\\Controllers\\PreferenceController::show", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PreferenceController", "fromLink": "App/Http/Controllers/PreferenceController.html", "link": "App/Http/Controllers/PreferenceController.html#method_all", "name": "App\\Http\\Controllers\\PreferenceController::all", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PreferenceController", "fromLink": "App/Http/Controllers/PreferenceController.html", "link": "App/Http/Controllers/PreferenceController.html#method_showByApplicant", "name": "App\\Http\\Controllers\\PreferenceController::showByApplicant", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PreferenceController", "fromLink": "App/Http/Controllers/PreferenceController.html", "link": "App/Http/Controllers/PreferenceController.html#method_addByApplicant", "name": "App\\Http\\Controllers\\PreferenceController::addByApplicant", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PreferenceController", "fromLink": "App/Http/Controllers/PreferenceController.html", "link": "App/Http/Controllers/PreferenceController.html#method_reorderByApplicantAjax", "name": "App\\Http\\Controllers\\PreferenceController::reorderByApplicantAjax", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PreferenceController", "fromLink": "App/Http/Controllers/PreferenceController.html", "link": "App/Http/Controllers/PreferenceController.html#method_deleteByApplicantAjax", "name": "App\\Http\\Controllers\\PreferenceController::deleteByApplicantAjax", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PreferenceController", "fromLink": "App/Http/Controllers/PreferenceController.html", "link": "App/Http/Controllers/PreferenceController.html#method_deleteByApplicant", "name": "App\\Http\\Controllers\\PreferenceController::deleteByApplicant", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PreferenceController", "fromLink": "App/Http/Controllers/PreferenceController.html", "link": "App/Http/Controllers/PreferenceController.html#method_showByProgram", "name": "App\\Http\\Controllers\\PreferenceController::showByProgram", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PreferenceController", "fromLink": "App/Http/Controllers/PreferenceController.html", "link": "App/Http/Controllers/PreferenceController.html#method_addByProgram", "name": "App\\Http\\Controllers\\PreferenceController::addByProgram", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PreferenceController", "fromLink": "App/Http/Controllers/PreferenceController.html", "link": "App/Http/Controllers/PreferenceController.html#method_deleteByProgram", "name": "App\\Http\\Controllers\\PreferenceController::deleteByProgram", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PreferenceController", "fromLink": "App/Http/Controllers/PreferenceController.html", "link": "App/Http/Controllers/PreferenceController.html#method_addUncoordinatedProgram", "name": "App\\Http\\Controllers\\PreferenceController::addUncoordinatedProgram", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PreferenceController", "fromLink": "App/Http/Controllers/PreferenceController.html", "link": "App/Http/Controllers/PreferenceController.html#method_createCoordinatedPreferences", "name": "App\\Http\\Controllers\\PreferenceController::createCoordinatedPreferences", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PreferenceController", "fromLink": "App/Http/Controllers/PreferenceController.html", "link": "App/Http/Controllers/PreferenceController.html#method_getLowestRankApplicant", "name": "App\\Http\\Controllers\\PreferenceController::getLowestRankApplicant", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/ProgramController.html", "name": "App\\Http\\Controllers\\ProgramController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\ProgramController", "fromLink": "App/Http/Controllers/ProgramController.html", "link": "App/Http/Controllers/ProgramController.html#method_index", "name": "App\\Http\\Controllers\\ProgramController::index", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProgramController", "fromLink": "App/Http/Controllers/ProgramController.html", "link": "App/Http/Controllers/ProgramController.html#method_add", "name": "App\\Http\\Controllers\\ProgramController::add", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProgramController", "fromLink": "App/Http/Controllers/ProgramController.html", "link": "App/Http/Controllers/ProgramController.html#method_create", "name": "App\\Http\\Controllers\\ProgramController::create", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProgramController", "fromLink": "App/Http/Controllers/ProgramController.html", "link": "App/Http/Controllers/ProgramController.html#method_store", "name": "App\\Http\\Controllers\\ProgramController::store", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProgramController", "fromLink": "App/Http/Controllers/ProgramController.html", "link": "App/Http/Controllers/ProgramController.html#method_show", "name": "App\\Http\\Controllers\\ProgramController::show", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProgramController", "fromLink": "App/Http/Controllers/ProgramController.html", "link": "App/Http/Controllers/ProgramController.html#method_all", "name": "App\\Http\\Controllers\\ProgramController::all", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProgramController", "fromLink": "App/Http/Controllers/ProgramController.html", "link": "App/Http/Controllers/ProgramController.html#method_edit", "name": "App\\Http\\Controllers\\ProgramController::edit", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProgramController", "fromLink": "App/Http/Controllers/ProgramController.html", "link": "App/Http/Controllers/ProgramController.html#method_delete", "name": "App\\Http\\Controllers\\ProgramController::delete", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProgramController", "fromLink": "App/Http/Controllers/ProgramController.html", "link": "App/Http/Controllers/ProgramController.html#method_update", "name": "App\\Http\\Controllers\\ProgramController::update", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProgramController", "fromLink": "App/Http/Controllers/ProgramController.html", "link": "App/Http/Controllers/ProgramController.html#method_getCapacity", "name": "App\\Http\\Controllers\\ProgramController::getCapacity", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProgramController", "fromLink": "App/Http/Controllers/ProgramController.html", "link": "App/Http/Controllers/ProgramController.html#method_setValid", "name": "App\\Http\\Controllers\\ProgramController::setValid", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProgramController", "fromLink": "App/Http/Controllers/ProgramController.html", "link": "App/Http/Controllers/ProgramController.html#method_setNonActive", "name": "App\\Http\\Controllers\\ProgramController::setNonActive", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProgramController", "fromLink": "App/Http/Controllers/ProgramController.html", "link": "App/Http/Controllers/ProgramController.html#method_activityCheck", "name": "App\\Http\\Controllers\\ProgramController::activityCheck", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/ProviderController.html", "name": "App\\Http\\Controllers\\ProviderController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\ProviderController", "fromLink": "App/Http/Controllers/ProviderController.html", "link": "App/Http/Controllers/ProviderController.html#method___construct", "name": "App\\Http\\Controllers\\ProviderController::__construct", "doc": "&quot;Create a new controller instance.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProviderController", "fromLink": "App/Http/Controllers/ProviderController.html", "link": "App/Http/Controllers/ProviderController.html#method_store", "name": "App\\Http\\Controllers\\ProviderController::store", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProviderController", "fromLink": "App/Http/Controllers/ProviderController.html", "link": "App/Http/Controllers/ProviderController.html#method_show", "name": "App\\Http\\Controllers\\ProviderController::show", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProviderController", "fromLink": "App/Http/Controllers/ProviderController.html", "link": "App/Http/Controllers/ProviderController.html#method_edit", "name": "App\\Http\\Controllers\\ProviderController::edit", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\ProviderController", "fromLink": "App/Http/Controllers/ProviderController.html", "link": "App/Http/Controllers/ProviderController.html#method_update", "name": "App\\Http\\Controllers\\ProviderController::update", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App\\Http", "fromLink": "App/Http.html", "link": "App/Http/Kernel.html", "name": "App\\Http\\Kernel", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Http\\Middleware", "fromLink": "App/Http/Middleware.html", "link": "App/Http/Middleware/EncryptCookies.html", "name": "App\\Http\\Middleware\\EncryptCookies", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Http\\Middleware", "fromLink": "App/Http/Middleware.html", "link": "App/Http/Middleware/RedirectIfAuthenticated.html", "name": "App\\Http\\Middleware\\RedirectIfAuthenticated", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Middleware\\RedirectIfAuthenticated", "fromLink": "App/Http/Middleware/RedirectIfAuthenticated.html", "link": "App/Http/Middleware/RedirectIfAuthenticated.html#method_handle", "name": "App\\Http\\Middleware\\RedirectIfAuthenticated::handle", "doc": "&quot;Handle an incoming request.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Middleware", "fromLink": "App/Http/Middleware.html", "link": "App/Http/Middleware/TrimStrings.html", "name": "App\\Http\\Middleware\\TrimStrings", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Http\\Middleware", "fromLink": "App/Http/Middleware.html", "link": "App/Http/Middleware/TrustProxies.html", "name": "App\\Http\\Middleware\\TrustProxies", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Http\\Middleware", "fromLink": "App/Http/Middleware.html", "link": "App/Http/Middleware/VerifyCsrfToken.html", "name": "App\\Http\\Middleware\\VerifyCsrfToken", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Http\\Requests", "fromLink": "App/Http/Requests.html", "link": "App/Http/Requests/ApplicantRequest.html", "name": "App\\Http\\Requests\\ApplicantRequest", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Requests\\ApplicantRequest", "fromLink": "App/Http/Requests/ApplicantRequest.html", "link": "App/Http/Requests/ApplicantRequest.html#method_authorize", "name": "App\\Http\\Requests\\ApplicantRequest::authorize", "doc": "&quot;Determine if the user is authorized to make this request.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Requests\\ApplicantRequest", "fromLink": "App/Http/Requests/ApplicantRequest.html", "link": "App/Http/Requests/ApplicantRequest.html#method_rules", "name": "App\\Http\\Requests\\ApplicantRequest::rules", "doc": "&quot;Get the validation rules that apply to the request.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Requests", "fromLink": "App/Http/Requests.html", "link": "App/Http/Requests/ReCaptchataRequest.html", "name": "App\\Http\\Requests\\ReCaptchataRequest", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Requests\\ReCaptchataRequest", "fromLink": "App/Http/Requests/ReCaptchataRequest.html", "link": "App/Http/Requests/ReCaptchataRequest.html#method_authorize", "name": "App\\Http\\Requests\\ReCaptchataRequest::authorize", "doc": "&quot;Determine if the user is authorized to make this request.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Requests\\ReCaptchataRequest", "fromLink": "App/Http/Requests/ReCaptchataRequest.html", "link": "App/Http/Requests/ReCaptchataRequest.html#method_rules", "name": "App\\Http\\Requests\\ReCaptchataRequest::rules", "doc": "&quot;Get the validation rules that apply to the request.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Requests", "fromLink": "App/Http/Requests.html", "link": "App/Http/Requests/UpdateGuardianRequest.html", "name": "App\\Http\\Requests\\UpdateGuardianRequest", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Requests\\UpdateGuardianRequest", "fromLink": "App/Http/Requests/UpdateGuardianRequest.html", "link": "App/Http/Requests/UpdateGuardianRequest.html#method_authorize", "name": "App\\Http\\Requests\\UpdateGuardianRequest::authorize", "doc": "&quot;Determine if the user is authorized to make this request.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Requests\\UpdateGuardianRequest", "fromLink": "App/Http/Requests/UpdateGuardianRequest.html", "link": "App/Http/Requests/UpdateGuardianRequest.html#method_rules", "name": "App\\Http\\Requests\\UpdateGuardianRequest::rules", "doc": "&quot;Get the validation rules that apply to the request.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Requests", "fromLink": "App/Http/Requests.html", "link": "App/Http/Requests/UpdateProgramRequest.html", "name": "App\\Http\\Requests\\UpdateProgramRequest", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Requests\\UpdateProgramRequest", "fromLink": "App/Http/Requests/UpdateProgramRequest.html", "link": "App/Http/Requests/UpdateProgramRequest.html#method_authorize", "name": "App\\Http\\Requests\\UpdateProgramRequest::authorize", "doc": "&quot;Determine if the user is authorized to make this request.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Requests\\UpdateProgramRequest", "fromLink": "App/Http/Requests/UpdateProgramRequest.html", "link": "App/Http/Requests/UpdateProgramRequest.html#method_rules", "name": "App\\Http\\Requests\\UpdateProgramRequest::rules", "doc": "&quot;Get the validation rules that apply to the request.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Requests", "fromLink": "App/Http/Requests.html", "link": "App/Http/Requests/UpdateProviderRequest.html", "name": "App\\Http\\Requests\\UpdateProviderRequest", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Requests\\UpdateProviderRequest", "fromLink": "App/Http/Requests/UpdateProviderRequest.html", "link": "App/Http/Requests/UpdateProviderRequest.html#method_authorize", "name": "App\\Http\\Requests\\UpdateProviderRequest::authorize", "doc": "&quot;Determine if the user is authorized to make this request.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Requests\\UpdateProviderRequest", "fromLink": "App/Http/Requests/UpdateProviderRequest.html", "link": "App/Http/Requests/UpdateProviderRequest.html#method_rules", "name": "App\\Http\\Requests\\UpdateProviderRequest::rules", "doc": "&quot;Get the validation rules that apply to the request.&quot;"},
            
            {"type": "Class", "fromName": "App\\Mail", "fromLink": "App/Mail.html", "link": "App/Mail/ApplicantMatchMail.html", "name": "App\\Mail\\ApplicantMatchMail", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Mail\\ApplicantMatchMail", "fromLink": "App/Mail/ApplicantMatchMail.html", "link": "App/Mail/ApplicantMatchMail.html#method___construct", "name": "App\\Mail\\ApplicantMatchMail::__construct", "doc": "&quot;Create a new message instance.&quot;"},
                    {"type": "Method", "fromName": "App\\Mail\\ApplicantMatchMail", "fromLink": "App/Mail/ApplicantMatchMail.html", "link": "App/Mail/ApplicantMatchMail.html#method_build", "name": "App\\Mail\\ApplicantMatchMail::build", "doc": "&quot;Build the message.&quot;"},
            
            {"type": "Class", "fromName": "App\\Mail", "fromLink": "App/Mail.html", "link": "App/Mail/GuardianVerifiedMail.html", "name": "App\\Mail\\GuardianVerifiedMail", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Mail\\GuardianVerifiedMail", "fromLink": "App/Mail/GuardianVerifiedMail.html", "link": "App/Mail/GuardianVerifiedMail.html#method___construct", "name": "App\\Mail\\GuardianVerifiedMail::__construct", "doc": "&quot;Create a new message instance.&quot;"},
                    {"type": "Method", "fromName": "App\\Mail\\GuardianVerifiedMail", "fromLink": "App/Mail/GuardianVerifiedMail.html", "link": "App/Mail/GuardianVerifiedMail.html#method_build", "name": "App\\Mail\\GuardianVerifiedMail::build", "doc": "&quot;Build the message.&quot;"},
            
            {"type": "Class", "fromName": "App\\Mail", "fromLink": "App/Mail.html", "link": "App/Mail/ProgramMatchMail.html", "name": "App\\Mail\\ProgramMatchMail", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Mail\\ProgramMatchMail", "fromLink": "App/Mail/ProgramMatchMail.html", "link": "App/Mail/ProgramMatchMail.html#method___construct", "name": "App\\Mail\\ProgramMatchMail::__construct", "doc": "&quot;Create a new message instance.&quot;"},
                    {"type": "Method", "fromName": "App\\Mail\\ProgramMatchMail", "fromLink": "App/Mail/ProgramMatchMail.html", "link": "App/Mail/ProgramMatchMail.html#method_build", "name": "App\\Mail\\ProgramMatchMail::build", "doc": "&quot;Build the message.&quot;"},
            
            {"type": "Class", "fromName": "App", "fromLink": "App.html", "link": "App/Matching.html", "name": "App\\Matching", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Matching", "fromLink": "App/Matching.html", "link": "App/Matching.html#method_resetMatches", "name": "App\\Matching::resetMatches", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App", "fromLink": "App.html", "link": "App/Preference.html", "name": "App\\Preference", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Preference", "fromLink": "App/Preference.html", "link": "App/Preference.html#method_updateStatus", "name": "App\\Preference::updateStatus", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Preference", "fromLink": "App/Preference.html", "link": "App/Preference.html#method_resetUncoordinated", "name": "App\\Preference::resetUncoordinated", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Preference", "fromLink": "App/Preference.html", "link": "App/Preference.html#method_hasPreferencesByProgram", "name": "App\\Preference::hasPreferencesByProgram", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Preference", "fromLink": "App/Preference.html", "link": "App/Preference.html#method_hasPreferencesByApplicant", "name": "App\\Preference::hasPreferencesByApplicant", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Preference", "fromLink": "App/Preference.html", "link": "App/Preference.html#method_getAvailableApplicants", "name": "App\\Preference::getAvailableApplicants", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Preference", "fromLink": "App/Preference.html", "link": "App/Preference.html#method_orderByCriteria", "name": "App\\Preference::orderByCriteria", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App", "fromLink": "App.html", "link": "App/Program.html", "name": "App\\Program", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Program", "fromLink": "App/Program.html", "link": "App/Program.html#method_getAll", "name": "App\\Program::getAll", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Program", "fromLink": "App/Program.html", "link": "App/Program.html#method_isCoordinated", "name": "App\\Program::isCoordinated", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Program", "fromLink": "App/Program.html", "link": "App/Program.html#method_getCoordinated", "name": "App\\Program::getCoordinated", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Program", "fromLink": "App/Program.html", "link": "App/Program.html#method_getProviderId", "name": "App\\Program::getProviderId", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Program", "fromLink": "App/Program.html", "link": "App/Program.html#method_getProgramByUid", "name": "App\\Program::getProgramByUid", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Program", "fromLink": "App/Program.html", "link": "App/Program.html#method_getProgramsByProid", "name": "App\\Program::getProgramsByProid", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App", "fromLink": "App.html", "link": "App/Provider.html", "name": "App\\Provider", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Provider", "fromLink": "App/Provider.html", "link": "App/Provider.html#method_getProviderByUid", "name": "App\\Provider::getProviderByUid", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App\\Providers", "fromLink": "App/Providers.html", "link": "App/Providers/AppServiceProvider.html", "name": "App\\Providers\\AppServiceProvider", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Providers\\AppServiceProvider", "fromLink": "App/Providers/AppServiceProvider.html", "link": "App/Providers/AppServiceProvider.html#method_boot", "name": "App\\Providers\\AppServiceProvider::boot", "doc": "&quot;Bootstrap any application services.&quot;"},
                    {"type": "Method", "fromName": "App\\Providers\\AppServiceProvider", "fromLink": "App/Providers/AppServiceProvider.html", "link": "App/Providers/AppServiceProvider.html#method_register", "name": "App\\Providers\\AppServiceProvider::register", "doc": "&quot;Register any application services.&quot;"},
            
            {"type": "Class", "fromName": "App\\Providers", "fromLink": "App/Providers.html", "link": "App/Providers/AuthServiceProvider.html", "name": "App\\Providers\\AuthServiceProvider", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Providers\\AuthServiceProvider", "fromLink": "App/Providers/AuthServiceProvider.html", "link": "App/Providers/AuthServiceProvider.html#method_boot", "name": "App\\Providers\\AuthServiceProvider::boot", "doc": "&quot;Register any authentication \/ authorization services.&quot;"},
            
            {"type": "Class", "fromName": "App\\Providers", "fromLink": "App/Providers.html", "link": "App/Providers/BroadcastServiceProvider.html", "name": "App\\Providers\\BroadcastServiceProvider", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Providers\\BroadcastServiceProvider", "fromLink": "App/Providers/BroadcastServiceProvider.html", "link": "App/Providers/BroadcastServiceProvider.html#method_boot", "name": "App\\Providers\\BroadcastServiceProvider::boot", "doc": "&quot;Bootstrap any application services.&quot;"},
            
            {"type": "Class", "fromName": "App\\Providers", "fromLink": "App/Providers.html", "link": "App/Providers/EventServiceProvider.html", "name": "App\\Providers\\EventServiceProvider", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Providers\\EventServiceProvider", "fromLink": "App/Providers/EventServiceProvider.html", "link": "App/Providers/EventServiceProvider.html#method_boot", "name": "App\\Providers\\EventServiceProvider::boot", "doc": "&quot;Register any events for your application.&quot;"},
            
            {"type": "Class", "fromName": "App\\Providers", "fromLink": "App/Providers.html", "link": "App/Providers/RouteServiceProvider.html", "name": "App\\Providers\\RouteServiceProvider", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Providers\\RouteServiceProvider", "fromLink": "App/Providers/RouteServiceProvider.html", "link": "App/Providers/RouteServiceProvider.html#method_boot", "name": "App\\Providers\\RouteServiceProvider::boot", "doc": "&quot;Define your route model bindings, pattern filters, etc.&quot;"},
                    {"type": "Method", "fromName": "App\\Providers\\RouteServiceProvider", "fromLink": "App/Providers/RouteServiceProvider.html", "link": "App/Providers/RouteServiceProvider.html#method_map", "name": "App\\Providers\\RouteServiceProvider::map", "doc": "&quot;Define the routes for the application.&quot;"},
                    {"type": "Method", "fromName": "App\\Providers\\RouteServiceProvider", "fromLink": "App/Providers/RouteServiceProvider.html", "link": "App/Providers/RouteServiceProvider.html#method_mapWebRoutes", "name": "App\\Providers\\RouteServiceProvider::mapWebRoutes", "doc": "&quot;Define the \&quot;web\&quot; routes for the application.&quot;"},
                    {"type": "Method", "fromName": "App\\Providers\\RouteServiceProvider", "fromLink": "App/Providers/RouteServiceProvider.html", "link": "App/Providers/RouteServiceProvider.html#method_mapApiRoutes", "name": "App\\Providers\\RouteServiceProvider::mapApiRoutes", "doc": "&quot;Define the \&quot;api\&quot; routes for the application.&quot;"},
            
            {"type": "Trait", "fromName": "App\\Traits", "fromLink": "App/Traits.html", "link": "App/Traits/GetPreferences.html", "name": "App\\Traits\\GetPreferences", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Traits\\GetPreferences", "fromLink": "App/Traits/GetPreferences.html", "link": "App/Traits/GetPreferences.html#method_getPreferencesByApplicant", "name": "App\\Traits\\GetPreferences::getPreferencesByApplicant", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Traits\\GetPreferences", "fromLink": "App/Traits/GetPreferences.html", "link": "App/Traits/GetPreferences.html#method_getPreferencesByProgram", "name": "App\\Traits\\GetPreferences::getPreferencesByProgram", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Traits\\GetPreferences", "fromLink": "App/Traits/GetPreferences.html", "link": "App/Traits/GetPreferences.html#method_getPreferencesUncoordinatedByProgram", "name": "App\\Traits\\GetPreferences::getPreferencesUncoordinatedByProgram", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Traits\\GetPreferences", "fromLink": "App/Traits/GetPreferences.html", "link": "App/Traits/GetPreferences.html#method_getNonActivePreferencesByProgram", "name": "App\\Traits\\GetPreferences::getNonActivePreferencesByProgram", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App", "fromLink": "App.html", "link": "App/User.html", "name": "App\\User", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Validators", "fromLink": "App/Validators.html", "link": "App/Validators/ReCaptcha.html", "name": "App\\Validators\\ReCaptcha", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Validators\\ReCaptcha", "fromLink": "App/Validators/ReCaptcha.html", "link": "App/Validators/ReCaptcha.html#method_validate", "name": "App\\Validators\\ReCaptcha::validate", "doc": "&quot;&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


