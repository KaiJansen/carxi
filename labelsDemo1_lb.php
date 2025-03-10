<?php
	include_once('include_taxi_webservices.php');
	include_once(TPATH_CLASS.'configuration.php');
	
	require_once('assets/libraries/stripe/config.php');
	require_once('assets/libraries/stripe/stripe-php-2.1.4/lib/Stripe.php');
	require_once('assets/libraries/pubnub/autoloader.php');
	include_once(TPATH_CLASS .'Imagecrop.class.php');
	include_once(TPATH_CLASS .'twilio/Services/Twilio.php');
	include_once('generalFunctions.php');
	include_once('send_invoice_receipt.php');

$dataLblArr=array();


$dataLblArr['LBL_SIGN_IN_TXT']='SIGN IN';
$dataLblArr['LBL_REGISTER_TXT']='Register';
$dataLblArr['LBL_LOADING_BAR_TXT']='Signing In...';
$dataLblArr['LBL_NO_INTERNET_TXT']='Please check your internet connection.';
$dataLblArr['LBL_RETRY_BTN_TXT_NO_INTERNET']='RETRY';
$dataLblArr['LBL_CANCEL_BTN_TXT_NO_INTERNET']='CANCEL';
$dataLblArr['LBL_USER_NAME_LBL_TXT']='USER NAME';
$dataLblArr['LBL_USER_NAME_HINT_TXT']='Enter Your Email Address';
$dataLblArr['LBL_PASSWORD_LBL_TXT']='Password';
$dataLblArr['LBL_PASSWORD_HINT_TXT']='Enter Your Password';
$dataLblArr['LBL_FB_LOADING_TXT']='Please Wait. We are Connecting to Facebook';
$dataLblArr['LBL_SIGN_IN_LOADING_TXT']='Signing In.. Please Wait';
$dataLblArr['LBL_FEILD_EMAIL_ERROR_TXT']='In Correct Email';
$dataLblArr['LBL_PASSWORD_ERROR_TXT']='In Correct Password';
$dataLblArr['LBL_REGISTRATION_PAGE_HEADER_TXT']='REGISTRATION';
$dataLblArr['LBL_FIRST_NAME_HEADER_TXT']='First Name';
$dataLblArr['LBL_LAST_NAME_HEADER_TXT']='Last Name';
$dataLblArr['LBL_MOBILE_NUMBER_HEADER_TXT']='Mobile';
$dataLblArr['LBL_MOBILE_NUMBER_HINT_TXT']='Mobile Number';
$dataLblArr['LBL_BTN_NEXT_TXT']='NEXT';
$dataLblArr['LBL_FEILD_REQUIRD_ERROR_TXT']='REQUIRED';
$dataLblArr['LBL_FEILD_PASSWORD_ERROR_TXT']='Password must be 5 to 10 character long with at least one lower case,upper case letter, number, any of special Character(@#$%^&_), and no white spaces.';
$dataLblArr['LBL_OR_TXT']='OR';
$dataLblArr['LBL_VERIFICATION_PAGE_HEADER']='VERIFICATION';
$dataLblArr['LBL_VERIFY_PASSWORD_HINT_TXT']='Enter Password Again';
$dataLblArr['LBL_VERIFY_PASSWORD_ERROR_TXT']='Password is not same.';
$dataLblArr['LBL_LOADING_VERIFICATION_TXT']='Pleast Wait..We are validating your information.';
$dataLblArr['LBL_PAYMENT_HEADER_TXT']='PAYMENT DETAIL';
$dataLblArr['LBL_CARD_NUMBER_HEADER_TXT']='Card No.';
$dataLblArr['LBL_CARD_NUMBER_HINT_TXT']='Enter Your Card Number';
$dataLblArr['LBL_EXP_DATE_HEADER_TXT']='Exp. Date';
$dataLblArr['LBL_EXP_MONTH_HINT_TXT']='MM';
$dataLblArr['LBL_EXP_YEAR_HINT_TXT']='YYYY';
$dataLblArr['LBL_CVV_HEADER_TXT']='CVV NO.';
$dataLblArr['LBL_CVV_HINT_TXT']='CVV';
$dataLblArr['LBL_BTN_REGISTER_TXT']='REGISTER';
$dataLblArr['LBL_REGISTER_LOADING_TXT']='Please Wait..We are registering You...';
$dataLblArr['LBL_ERROR_CARD_NUMBER_TXT']='In Valid card Details..';
$dataLblArr['LBL_ERROR_CVV_NUMBER_TXT']='In Correct CVV';
$dataLblArr['LBL_PICKUP_LOCATION_HEADER_TXT']='PICK UP LOCATION';
$dataLblArr['LBL_SET_PICK_UP_LOCATION_TXT']='Set Pickup Location';
$dataLblArr['LBL_SOURCE_CONFIRM_HEADER_TXT']='CONFIRMATION';
$dataLblArr['LBL_BTN_REQUEST_PICKUP_TXT']='Request Pickup';
$dataLblArr['LBL_LOADING_REQUEST_RIDE_TXT']='Requesting your Ride.. Please Wait for Moment..';
$dataLblArr['LBL_USER_NAME_HEADER_SLIDE_TXT']='Name';
$dataLblArr['LBL_MY_PROFILE_HEADER_TXT']='My Profile';
$dataLblArr['LBL_BOOKING_HISTROY_TXT']='BOOKING HISTROY';
$dataLblArr['LBL_ABOUT_US_TXT']='About Us';
$dataLblArr['LBL_HELP_TXT']='Help';
$dataLblArr['LBL_SIGNOUT_TXT']='Sign Out';
$dataLblArr['LBL_BTN_CANCEL_TRIP_TXT']='Cancel';
$dataLblArr['LBL_BTN_MESSAGE_TXT']='Message to Driver';
$dataLblArr['LBL_MESSAGE_PAGE_HEADER_TXT']='MESSAGING';
$dataLblArr['LBL_BTN_SEND_TXT']='Send';
$dataLblArr['LBL_WRITE_MESSAGE_HINT_TXT']='Write Comment';
$dataLblArr['LBL_LOADING_CANCEL_TRIP_TXT']='Cancelling your trip.. Please Wait..';
$dataLblArr['LBL_TRIP_CANCEL_TXT']='Are you sure. You want to cancel your trip?';
$dataLblArr['LBL_BTN_TRIP_CANCEL_CONFIRM_TXT']='Confirm';
$dataLblArr['LBL_START_TRIP_DIALOG_TXT']='Your trip has begun.';
$dataLblArr['LBL_BTN_OK_TXT']='OK';
$dataLblArr['LBL_END_TRIP_DIALOG_TXT']='Your Trip is completed.';
$dataLblArr['LBL_SELECT_DESTINATION_HEADER_TXT']='Select Destination';
$dataLblArr['LBL_SEARCH_PLACE_HINT_TXT']='Search Place';
$dataLblArr['LBL_KNOW_ARRIVAL_TIME_TXT']='KNOW YOUR ARRIVAL TIME';
$dataLblArr['LBL_APPROX_DISTANCE_TXT']='Approx.';
$dataLblArr['LBL_KM_DISTANCE_TXT']='km';
$dataLblArr['LBL_CONFIRM_DEST_HEADER_TXT']='Confirm Your Destination';
$dataLblArr['LBL_BTN_CONFIRM_DEST_TXT']='Confirm Destination';
$dataLblArr['LBL_RATE']='Rate';
$dataLblArr['LBL_TRIP_SUMMARY_TXT']='TRIP SUMMARY';
$dataLblArr['LBL_PAYMENT_FAILED_PREFIX_TXT']='Payment Failed. Please contact us. Your Transaction Id is';
$dataLblArr['LBL_COMMENT_AREA_HEADER_TXT']='Leave a Comment';
$dataLblArr['LBL_BTN_SUBMIT_TXT']='Submit';
$dataLblArr['LBL_BTN_PAYMENT_TXT']='Pay';
$dataLblArr['LBL_ERROR_COMMENT_DIALOG_TXT']='Please write Something';
$dataLblArr['LBL_ERROR_RATING_DIALOG_TXT']='Please Rate this Trip..';
$dataLblArr['LBL_LOADING_PAYMENT_VERIFY_TXT']='Please Wait for verification Process';
$dataLblArr['LBL_PROFILE_TITLE_TXT']='My Profile';
$dataLblArr['LBL_USER_NAME_HEADER_TXT']='USER NAME';
$dataLblArr['LBL_BTN_UPDATE_PROFILE_TXT']='Update Profile Information';
$dataLblArr['LBL_PAYMENT_INFO_HEADER_TXT']='PAYMENT INFO.';
$dataLblArr['LBL_BTN_UPDATE_PAYMENT_TXT']='Update Payment Information';
$dataLblArr['LBL_PLACES_HEADER_TXT']='PLACES';
$dataLblArr['LBL_PROFILE_UPDATE_TITLE_TXT']='UPDATE PROFILE';
$dataLblArr['LBL_CHANGE_PASSWORD_TXT']='Change Password';
$dataLblArr['LBL_BTN_PROFILE_UPDATE_PAGE_TXT']='Update Information';
$dataLblArr['LBL_NO_CHANGE_TXT']='Sorry No Update. Please make a change First..';
$dataLblArr['LBL_UPDATE_PASSWORD_HEADER_TXT']='New Password';
$dataLblArr['LBL_UPDATE_PASSWORD_HINT_TXT']='Enter New Password';
$dataLblArr['LBL_UPDATE_CONFIRM_PASSWORD_HEADER_TXT']='RE ENTER PASSWORD';
$dataLblArr['LBL_UPDATE_CONFIRM_PASSWORD_HINT_TXT']='Enter new password Again';
$dataLblArr['LBL_BTN_UPDATE_PAYMENT_INFO_TXT']='Update Payment Information';
$dataLblArr['LBL_ABOUT_US_HEADER_TXT']='About Us';
$dataLblArr['LBL_CONTACT_US_HEADER_TXT']='Contact Us';
$dataLblArr['LBL_BTN_ACCOUNT_TXT']='Account';
$dataLblArr['LBL_BTN_MAP_TXT']='Go To Map';
$dataLblArr['LBL_GO_ONLINE_TXT']='Go Online';
$dataLblArr['LBL_GO_OFFLINE_TXT']='Go Offline';
$dataLblArr['LBL_ONLINE_HEADER_TXT']='You Are Online';
$dataLblArr['LBL_OFFLINE_HEADER_TXT']='You Are Offline';
$dataLblArr['LBL_SELECT_CAR_TXT']='Select Your Car';
$dataLblArr['LBL_BTN_REFER_TXT']='REFER NOW';
$dataLblArr['LBL_LOADING_CALL_TO_USER_TXT']='Requesting...Please Wait...';
$dataLblArr['LBL_SUCCESS_ASSIGN_TO_PASSENGER_TXT']='You are assigned to Passenger..';
$dataLblArr['LBL_FAIL_ASSIGN_TO_PASSENGER_TXT']='Sorry Another Driver has been assigned..';
$dataLblArr['LBL_TIMER_FINISHED_TXT']='Time up!';
$dataLblArr['LBL_BTN_START_NAVIGATION_TXT']='Start Navigation';
$dataLblArr['LBL_BTN_ARRIVED_TXT']='ARRIVED';
$dataLblArr['LBL_ARRIVED_CONFIRM_DIALOG_TXT']='Are you sure you have arrived at pickup location of passenger? If yes click OK else cancel.';
$dataLblArr['LBL_ARRIVED_DIALOG_BTN_BACK_TXT']='BACK';
$dataLblArr['LBL_ARRIVED_DIALOG_BTN_CONTINUE_TXT']='CONTINUE';
$dataLblArr['LBL_LOADING_FIND_ROUTE_TXT']='Please Wait..We are finding minimum Route..';
$dataLblArr['LBL_BTN_START_TRIP_TXT']='Start a Trip';
$dataLblArr['LBL_BTN_END_TRIP_TXT']='End a Trip';
$dataLblArr['LBL_FARE_AREA_TXT']='We are calculating fare. You will receive it soon..';
$dataLblArr['LBL_ADD_DESTINATION_BTN_TXT']='Add Destination';
$dataLblArr['LBL_CANNOT_BACK_TXT']='You Can\'t go back from this screen.';
$dataLblArr['LBL_PROCESS_FAILED_TXT']='Process Failed. Please try again.';
$dataLblArr['LBL_FAILED_UPDATE_STATUS']='Failed to update your status. Please try again.';
$dataLblArr['LBL_GO_SIGNUP_DRIVER_TXT']='Not yet registered? Click to sign up.';
$dataLblArr['LBL_TEST1']='testing123';
$dataLblArr['LBL_ERROR_OCCURED']='Sorry. Some Error Occurred. Please try again Later.';
$dataLblArr['LBL_FORGET_PASS_TXT']='Forgot password?';
$dataLblArr['LBL_PLEASE_WAIT_TXT']='Please Wait';
$dataLblArr['LBL_ADD_CORRECT_DETAIL_TXT']='Please add correct details.';
$dataLblArr['LBL_EMAIL_LBL_TXT']='Email';
$dataLblArr['LBL_LOADING_GET_INFORMATION_TXT']='Please Wait. We are getting your information.';
$dataLblArr['LBL_ADD_SUBJECT_HINT_CONTACT_TXT']='Enter subject here';
$dataLblArr['LBL_SERVICE_NOT_AVAIL_TXT']='Service Not Available. Please try again Later.';
$dataLblArr['LBL_SEND_CONTACT_QUERY_LOADING_TXT']='Submitting your query. Please wait.';
$dataLblArr['LBL_ERROR_TXT']='Error';
$dataLblArr['LBL_NO_REG_FOUND']='No Registration Found';
$dataLblArr['LBL_SENT_CONTACT_QUERY_SUCCESS_TXT']='Your query has been successfully sent.';
$dataLblArr['LBL_SIGN_UP_TXT']='Please Sign Up';
$dataLblArr['LBL_ALREADY_REGISTERED_TXT']='You are already Registered. Please Sign In.';
$dataLblArr['LBL_FAILED_SEND_CONTACT_QUERY_TXT']='Failed to send your query.';
$dataLblArr['LBL_VERIFICATION_MOBILE_FAILED_TXT']='Sorry validation failed. Make sure Entered mobile number is correct.';
$dataLblArr['LBL_WRITE_BELOW_CONTACT_US_TXT']='Please add below details.';
$dataLblArr['LBL_SEND_QUERY_BTN_TXT']='Send Query';
$dataLblArr['LBL_BTN_VERIFY_TXT']='Verify';
$dataLblArr['LBL_SKIP_TXT']='SKIP';
$dataLblArr['LBL_REGISTERATION_FAILED_TXT']='Sorry..Registration is Unsuccessful..Please Try Again Later.';
$dataLblArr['LBL_CHECK_INBOX_TXT']='Email sent successfully. Please check your inbox.';
$dataLblArr['LBL_SEND_EMAIL_LOADING_TXT']='Sending mail. Please wait';
$dataLblArr['LBL_ADD_INFO_WARNING_TXT']='Please add information.';
$dataLblArr['LBL_FAILED_SEND_RECEIPT_EMAIL_TXT']='Failed to send email.';
$dataLblArr['LBL_TAXI_SELECTION_GO_TXT']='Taxi Go';
$dataLblArr['LBL_TAXI_SELECTION_X_TXT']='Taxi X';
$dataLblArr['LBL_GET_RECEIPT_TXT']='GET RECEIPT';
$dataLblArr['LBL_TAXI_SELECTION_FAMILY_TXT']='Family';
$dataLblArr['LBL_UPDATE_INFO_FAILED_TXT']='Update Failed.';
$dataLblArr['LBL_LOADING_PLACE_TXT']='Loading Places...';
$dataLblArr['LBL_LAST_NAME_HINT_TXT']='Enter Last Name';
$dataLblArr['LBL_NO_DRIVER_AVAIL_TXT']='Sorry No Driver Available..';
$dataLblArr['LBL_FIRST_NAME_HINT_TXT']='Enter First Name';
$dataLblArr['LBL_SORRY_PROBLEM_TXT']='Sorry for the problem..';
$dataLblArr['LBL_FAILED_TRIP_CANCEL']='Trip is not cancelled..';
$dataLblArr['LBL_WAIT_UPLOAD_IMAGE_LOADING_TXT']='Uploading image. Please Wait.';
$dataLblArr['LBL_INFO_SET_TXT']='Setting Up Information..\\n Please Wait..';
$dataLblArr['LBL_DEVICE_NOT_SUPPORTED_TXT']='This device is not supported.';
$dataLblArr['LBL_INACTIVE_CARS_MESSAGE_TXT']='We see you have not added any taxi.Kindly add from my Taxi Page.';
$dataLblArr['LBL_SELECTING_LOCATION_TXT']='Selecting Location';
$dataLblArr['LBL_SELECT_CAR_MESSAGE_TXT']='Please select your car.';
$dataLblArr['LBL_ADD_HOME_PLACE_TXT']='Add Home';
$dataLblArr['LBL_ADD_WORK_PLACE_TXT']='Add Work';
$dataLblArr['LBL_UPDATE_USER_PHONE_HINT_TXT']='Enter your Mobile Number';
$dataLblArr['LBL_ADD_CAR_MESSAGE_DRIVER']='Please add your car through website.';
$dataLblArr['LBL_BTN_UPDATE_PASSWORD_TXT']='Update Password';
$dataLblArr['LBL_CONTACT_US_STATUS_NOTACTIVE_DRIVER']='Oops! Seems your account is inactive.Kindly contact administartor.';
$dataLblArr['LBL_PAYMENT_CARD_ENTER_TXT']='Please enter your card detail..';
$dataLblArr['LBL_PASS_UPDATE_LOADING_TXT']='Updating Your Password..Please Wait...';
$dataLblArr['LBL_CONTACT_US_STATUS_NOTACTIVE_PASSENGER']='Your status is inactive, Please visit our website.';
$dataLblArr['LBL_UPDATE_PROFILE_INFO_LOADING_TXT']='Updating your Profile Information..Please Wait...';
$dataLblArr['LBL_NO_RIDES_TXT']='You have no Rides..';
$dataLblArr['LBL_SEARCH_CAR_WAIT_TXT']='Searching Car';
$dataLblArr['LBL_UPDATE_PAYMENT_INFO_LOADING_TXT']='Updating Payment Information..Please Wait...';
$dataLblArr['LBL_ALREADY_OFFLINE_TXT']='You are already Offline';
$dataLblArr['LBL_TRIP_DETAIL_HEADER_TXT']='Trip Detail';
$dataLblArr['LBL_CHAT_TXT']='Chat';
$dataLblArr['LBL_RECEIPT_HEADER_TXT']='RECEIPT';
$dataLblArr['LBL_RIDE_NO_TXT']='Ride No.#';
$dataLblArr['LBL_NUMBER_TXT']='Number';
$dataLblArr['LBL_NO_LOCATION_FOUND_TXT']='Sorry. We are not able to get your Location. Please try again later.';
$dataLblArr['LBL_PASSENGER_TXT']='Passenger';
$dataLblArr['LBL_DRIVER_TXT']='Driver';
$dataLblArr['LBL_TRY_AGAIN_TXT']='Please try again';
$dataLblArr['LBL_SOURCE_ADD_TXT']='Source Address';
$dataLblArr['LBL_DEST_ADD_TXT']='Destination Address';
$dataLblArr['LBL_TROUBLE_TXT']='We are in trouble. Please try again later';
$dataLblArr['LBL_TRIP_DATE_TXT']='Trip Date';
$dataLblArr['LBL_TOTAL_FAIR_TXT']='Total Fair';
$dataLblArr['LBL_WAIT_CONFIRM_BY_DRIVER_TXT']='Please Wait for driver\'s confirmation.';
$dataLblArr['LBL_DOLLAR_SIGN_TXT']='$';
$dataLblArr['LBL_TRIP_STATUS_TXT']='Trip Status';
$dataLblArr['LBL_BTN_VIEW_MESSAGES_TXT']='View Messages';
$dataLblArr['LBL_CAR_REQUEST_CANCELLED_TXT']='Request has been cancelled by passenger.';
$dataLblArr['LBL_CANCELED_TRIP_TXT']='You have cancelled this Trip';
$dataLblArr['LBL_FINISHED_TRIP_TXT']='Your Trip was successfully Finished.';
$dataLblArr['LBL_ENTER_DESTINATION_HINT_TXT']='Enter Destination';
$dataLblArr['LBL_TRIP_GOING_TXT']='Your Trip is going on.';
$dataLblArr['LBL_AT_TXT']='at';
$dataLblArr['LBL_THANKS_RIDING_TXT']='Thanks for Riding With Us.';
$dataLblArr['LBL_NO_ROUTE_FOUND_TXT']='We did not find any routes. Please select another location.';
$dataLblArr['LBL_TRIP_REQUEST_DATE_TXT']='TRIP REQUEST DATE';
$dataLblArr['LBL_DROP_OFF_LOCATION_TXT']='DROP OFF LOCATION';
$dataLblArr['LBL_NOT_ABEL_PERFORM_TXT']='Not able to perform your request. please try again later.';
$dataLblArr['LBL_BILLED_CARD_HEADER_TXT']='BILLED TO CARD';
$dataLblArr['LBL_FARE_CALC_TXT']='FARE CALCULATION';
$dataLblArr['LBL_FARE_BREAK_DOWN_TXT']='Fare Breakdown';
$dataLblArr['LBL_BASE_FARE_SMALL_TXT']='Base Fare';
$dataLblArr['LBL_CHARGES_TXT']='CHARGES';
$dataLblArr['LBL_SERVICE_TAX_TXT']='Service Tax';
$dataLblArr['LBL_SUBTOTAL_TXT']='Subtotal';
$dataLblArr['LBL_FARE_TXT']='Fare';
$dataLblArr['LBL_CASH_PAYMENT_TXT']='Cash Payment';
$dataLblArr['LBL_TIME_TXT']='Time';
$dataLblArr['LBL_CHARGE_SUB_TOTAL_TXT']='Charge subtotal';
$dataLblArr['LBL_PAYPAL_PAYMENT_TXT']='Paypal Payment';
$dataLblArr['LBL_DISCOUNTS_TXT']='DISCOUNTS';
$dataLblArr['LBL_ROUNDING_DOWN_TXT']='Rounding Down';
$dataLblArr['LBL_ADD_WORK_PLACE_HINT_TXT']='Enter work location';
$dataLblArr['LBL_DISCOUNTS_SUB_TOTAL_TXT']='Discounts subtotal';
$dataLblArr['LBL_ADD_WORK_HEADER_TXT']='ADD WORK';
$dataLblArr['LBL_TOTALS_TXT']='TOTALS';
$dataLblArr['LBL_UBER_CREDIT_TXT']='projectName Credit';
$dataLblArr['LBL_ADD_PLACE_TXT']='Add Place';
$dataLblArr['LBL_OUSTING_BALANCE_TXT']='Outstanding Balance';
$dataLblArr['LBL_ENTER_HOME_LOC_HINT_TXT']='Enter home location';
$dataLblArr['LBL_TRIP_STATISTICS_TXT']='Trip Statistics';
$dataLblArr['LBL_DISTANCE_TXT']='Distance';
$dataLblArr['LBL_DURATION_TXT']='DURATION';
$dataLblArr['LBL_LONG_TOUCH_CHANGE_LOC_TXT']='Long touch on map to change location';
$dataLblArr['LBL_AVERAGE_SPEED_TXT']='AVERAGE SPEED';
$dataLblArr['LBL_SPEED_TXT']='Speed';
$dataLblArr['LBL_SOME_ERROR_TXT']='Sorry some problem occurred. please try again later.';
$dataLblArr['LBL_COMPANY_NAME_TXT']='Company Name goes';
$dataLblArr['LBL_COMPANY_ADDRESS_TXT']='223, Lorem Address goes Here';
$dataLblArr['LBL_SETTING_LOCATION_TXT']='Setting up location. Please Wait';
$dataLblArr['LBL_SUPPORT_HEADER_TXT']='Support';
$dataLblArr['LBL_ADD_HOME_BIG_TXT']='ADD HOME';
$dataLblArr['LBL_SUPPORT_EMAIL_TXT']='demo@demo.com';
$dataLblArr['LBL_METER_PAR_SEC_TXT']='meter/sec';
$dataLblArr['LBL_REQUEST_CANCELED_TXT']='Your Request is cancelled.';
$dataLblArr['LBL_HOURS_TXT']='hours';
$dataLblArr['LBL_CANCELING_TXT']='CANCELING';
$dataLblArr['LBL_MINUTES_TXT']='minutes';
$dataLblArr['LBL_SECONDS_TXT']='seconds';
$dataLblArr['LBL_HOLD_TO_CANCEL_TXT']='HOLD TO CANCEL';
$dataLblArr['LBL_CANCELED_TXT']='cancelled';
$dataLblArr['LBL_ON_WAY_TXT']='On the Way';
$dataLblArr['LBL_REQUESTING_TXT']='REQUESTING';
$dataLblArr['LBL_FINISHED_TXT']='Finished';
$dataLblArr['LBL_HOW_HELP_HEADER_TXT']='HOW CAN WE HELP?';
$dataLblArr['LBL_ACT_RESULTS_CANCEL_TXT']='You have Cancelled.';
$dataLblArr['LBL_CHOOSE_QUESTION_TXT']='Choose Question';
$dataLblArr['LBL_LEARN_MORE_TXT']='LEARN MORE';
$dataLblArr['LBL_ABOUT_US_DETAIL_TXT']='You can ask for rescue here.';
$dataLblArr['LBL_SEND_STATUS_CONTENT_TXT']='Hey, I am using projectName. Check my location:';
$dataLblArr['LBL_CONTACT_US_WRITE_EMAIL_TXT']='Write your query here.';
$dataLblArr['LBL_ARRIVING_TXT']='ARRIVING';
$dataLblArr['LBL_ON_TRIP_TXT']='ON TRIP';
$dataLblArr['LBL_PROBLEM_WITH_CONNECTION_SERVER_TXT']='Sorry... We are in trouble to get Connection with Server. Please try again later..';
$dataLblArr['LBL_CALL_TXT']='Call';
$dataLblArr['LBL_MESSAGE_TXT']='Message';
$dataLblArr['LBL_LICENCE_PLATE_TXT']='Licence Plate';
$dataLblArr['LBL_EN_ROUTE_TXT']='EN ROUTE';
$dataLblArr['LBL_UPDATE_DRIVER_CAR_LOADING_TXT']='Updating Your Car...Please Wait...';
$dataLblArr['LBL_MIN_SMALL_TXT']='min';
$dataLblArr['LBL_NO_CAR_AVAIL_TXT']='No Cars Available';
$dataLblArr['LBL_UPDATE_STATUS_DRIVER_LOADING_TXT']='Please Wait... Your Status is updating NOW';
$dataLblArr['LBL_PRMO_TXT']='Promo';
$dataLblArr['LBL_SUCCESS_STATUS_UPDATE_DRIVER_TXT']='Update Successful...';
$dataLblArr['LBL_PAYPAL_TXT']='Paypal';
$dataLblArr['LBL_FARE_ESTIMATE_TXT']='Fare Estimate';
$dataLblArr['LBL_FAILED_STATUS_UPDATE_DRIVER_TXT']='Update Unsuccessful...';
$dataLblArr['LBL_CASH_TXT']='Cash';
$dataLblArr['LBL_AM_TXT']='AM';
$dataLblArr['LBL_AND_TXT']='AND';
$dataLblArr['LBL_PM_TXT']='PM';
$dataLblArr['LBL_NAVIGATION_HEADER_TXT']='NAVIGATION';
$dataLblArr['LBL_KM_TXT']='KM';
$dataLblArr['LBL_MENU_MESSAGES_TXT']='Messages';
$dataLblArr['LBL_MIN_TXT']='MIN';
$dataLblArr['LBL_NOT_SUPPORT_CAMERA_TXT']='Sorry! Your device doesn\'t support camera';
$dataLblArr['LBL_FARE_DETAIL_TXT']='FARE DETAIL';
$dataLblArr['LBL_BASE_FARE_TXT']='BASE FARE';
$dataLblArr['LBL_FAILED_CAPTURE_IMAGE_TXT']='Sorry! Failed to capture image';
$dataLblArr['LBL_PEOPLE_TXT']='PEOPLE';
$dataLblArr['LBL_PASSENGER_CANCEL_TRIP_TXT']='Passenger cancelled this Trip.';
$dataLblArr['LBL_GET_FARE_EST_TXT']='GET FARE ESTIMATE';
$dataLblArr['LBL_TRIP_FINISHED_TXT']='Trip has been completed successfully.';
$dataLblArr['LBL_MAX_SIZE_TXT']='MAX SIZE';
$dataLblArr['LBL_MIN_FARE_TXT']='MIN. FARE';
$dataLblArr['LBL_PAYMENT_FAILED_TXT']='payment failed';
$dataLblArr['LBL_ETA_TXT']='ETA';
$dataLblArr['LBL_TRIP_NUMBER_TXT']='Trip Number';
$dataLblArr['desc']='desc en';
$dataLblArr['LBL_YOUR_TRIP_NUM_TXT']='Your Trip Number is';
$dataLblArr['LBL_ADD_COMMENT_TXT']='Add Comment';
$dataLblArr['LBL_ERROR_RATING_SUBMIT_AGAIN_TXT']='You are Not able to submit Your Ratings Again.';
$dataLblArr['LBL_REQUEST_CANCEL_FAILED_TXT']='Sorry. Request is not cancelled. Please try again later.';
$dataLblArr['LBL_SUCCESS_RATING_SUBMIT_TXT']='Your Ratings has been Successfully Submitted..';
$dataLblArr['LBL_SELECT_TXT']='Select';
$dataLblArr['LBL_ADD_PAYMENT_DETAIL_TXT']='Please Add Your Payment Detail';
$dataLblArr['LBL_MOBILE_VERIFICATION_FAILED_TXT']='Mobile Verification Failed. Please check your entered Mobile Number or try again Later.';
$dataLblArr['LBL_PAYMENT_VERIFICATION_FAILD_TXT']='Payment is not verified.';
$dataLblArr['LBL_UPDATING_LANGUAGE_LOADING_TXT']='Updating your Language. Please Wait...';
$dataLblArr['LBL_BTN_SLIDE_BEGIN_TRIP_TXT']='SLIDE TO BEGIN TRIP';
$dataLblArr['LBL_FAILED_UPDATE_LANGUAGE_TXT']='Failed to update your Language.';
$dataLblArr['LBL_BTN_SLIDE_END_TRIP_TXT']='SLIDE TO END TRIP';
$dataLblArr['LBL_ENTER_VERIFICATION_CODE_TXT']='Enter Verification Code that you have received from sms';
$dataLblArr['LBL_SELECTED_LANGUAGE_TXT']='Selected Language';
$dataLblArr['LBL_ERROR_VERIFICATION_CODE_TXT']='Please Enter Correct Code..';
$dataLblArr['LBL_WRONG_MOBILE_TXT']='Wrong phone number';
$dataLblArr['LBL_ERROR_VERIFY_TRIP_TXT']='Please Rate and verify this Trip.';
$dataLblArr['LBL_MISS_CALL_NUM_ERROR_TXT']='Please enter number or copy from call log';
$dataLblArr['LBL_VERIFICATION_CODE_TXT']='Your verification code for CubTaxi Application is';
$dataLblArr['LBL_IN_CORRECT_CODE_TXT']='You have entered Incorrect Code. Please Check it Again.';
$dataLblArr['LBL_PASTE_NUMBER_TXT']='Copy Paste the number from Call log';
$dataLblArr['LBL_COMMENT_TXT']='COMMENT';
$dataLblArr['LBL_VERIFICATION_MOBILE_TXT']='We are verifying your Mobile Number. System will call you. Please Wait.';
$dataLblArr['LBL_ADD_COMMENT_HEADER_TXT']='Add Comment On Your Trip';
$dataLblArr['LBL_SELECT_LANGUAGE_HINT_TXT']='Select Language';
$dataLblArr['LBL_WRITE_COMMENT_HINT_TXT']='Enter your comment.';
$dataLblArr['LBL_COUNTRY_TXT']='Country';
$dataLblArr['LBL_ENTER_CODE_HEADER_TXT']='Please Enter Your Code Below';
$dataLblArr['LBL_SELECT_LANGUAGE']='Please Select Language.';
$dataLblArr['LBL_MOBILE_EXIST']='This mobile number is already registered.';
$dataLblArr['LBL_PASS_UPDATE_SUCCESS']='Password updated.';
$dataLblArr['LBL_CURR_PASS_HEADER']='Current Password';
$dataLblArr['LBL_SAME_PASS_ERROR_TXT']='Password must be same.';
$dataLblArr['LBL_CONTACT_US_STATUS_NOTACTIVE_COMPANY']='Oops! Seems your company is inactive.Kindly contact administrator.';
$dataLblArr['LBL_PAYPAL_FAILED_NOTE_ONE_TXT']='Payment failed! Please contact us with your payment ID:';
$dataLblArr['LBL_PAYPAL_FAILED_NOTE_TWO_TXT']='\\nOR\\nDon\'t close app and try again.';
$dataLblArr['LBL_PAYPAL_STATUS_FAILED_TXT']='Your payment is not approved. Please try again.';
$dataLblArr['LBL_SHARE_BTN_TXT']='Share';
$dataLblArr['LBL_CHECK_INTERNET_TXT']='Error occurred. Please check your internet connection.';
$dataLblArr['LBL_LOADING_TXT']='Loading';
$dataLblArr['LBL_FAILED_TXT']='Failed';
$dataLblArr['LBL_RETRY_TXT']='Retry';
$dataLblArr['LBL_ERROR_OCCURED_TXT']='Error Occurred';
$dataLblArr['LBL_LOGIN_REQUIRED_TXT']='Please enter your login credentials.';
$dataLblArr['LBL_FEILD_EMAIL_ERROR_TXT_IPHONE']='Please enter correct email address.';
$dataLblArr['LBL_EMAIL_EXIST_TXT']='Email Id already registered!';
$dataLblArr['LBL_DO_SIGN_IN_TXT']='Please Sign In.';
$dataLblArr['LBL_ENTER_DETAILS_TXT']='Please enter details';
$dataLblArr['LBL_CONFIRM_PASSWORD_TXT']='Please confirm yor password';
$dataLblArr['LBL_DO_SIGNUP_TXT']='Don\'t have an account? Click to sign up.';
$dataLblArr['LBL_CANCEL_TXT']='Cancel';
$dataLblArr['LBL_CONTACT_TXT']='Contact';
$dataLblArr['LBL_EDIT_PROFILE_TXT']='Edit Profile';
$dataLblArr['LBL_VIEW_PROFILE_TXT']='View Profile';
$dataLblArr['LBL_NO_UPDATE_TXT']='No update';
$dataLblArr['LBL_CHANGE_INFO_TXT']='please change information.';
$dataLblArr['LBL_TRY_AGAIN_LATER_TXT']='Please try again later.';
$dataLblArr['LBL_LANG_UPDATED_TXT']='Language is updated.';
$dataLblArr['LBL_INFO_UPDATED_TXT']='Information is updated.';
$dataLblArr['LBL_CURR_PASS_ERROR_TXT']='Current password does not match.';
$dataLblArr['LBL_ENTER_SAME_PASS_TXT']='You have entered same password';
$dataLblArr['LBL_HOME_PLACE_ADD_TXT']='Please add home place';
$dataLblArr['LBL_WORK_PLACE_ADD_TXT']='Please add work place.';
$dataLblArr['LBL_CHOOSE_COUNTRY_TXT']='Choose Country';
$dataLblArr['LBL_CONFIRM_REQUEST_CANCEL_TXT']='Do you want to cancel request?';
$dataLblArr['LBL_FIND_DESTINATION_TXT']='Please find your destination';
$dataLblArr['LBL_SUCCESS_TXT']='SUCCESS';
$dataLblArr['LBL_DECLINE_TXT']='DECLINE';
$dataLblArr['LBL_ACCEPT_TXT']='ACCEPT';
$dataLblArr['LBL_CONFIRM_START_TRIP_TXT']='Are you sure? You want to start trip.';
$dataLblArr['LBL_CONFIRM_END_TRIP_TXT']='Are you sure? You want to end trip.';
$dataLblArr['LBL_BTN_FINISH_TRIP_TXT']='Finish your trip';
$dataLblArr['LBL_NO_INTERNET_IPHONE_TXT']='This app requires internet connection. Please enabled it from device settings.';
$dataLblArr['LBL_NO_PUSH_IPHONE_TXT']='This app requires push notification service. Please enabled push notification service from device settings. Go to Settings >> Notification >> (Select app) >> Allow Notifications';
$dataLblArr['LBL_NO_LOCATION_IPHONE_TXT']='This app requires location services. Please enabled location service from device settings. Go to Settings >> Privacy >> Location Services >> (Select app) >> Always';
$dataLblArr['LBL_NO_LOCATION_PUSH_IPHONE_TXT']='Please enable Location and Notification services from device settings. For Location : Go to Settings >> Privacy >> Location Services >> Select app ) >> Always. And for Notification: Go to Settings >> Notifications >> Select app';
$dataLblArr['LBL_FACEBOOK_ACC_EXIST']='This facebook account already exist.';
$dataLblArr['LBL_MISS_CALL_GEN_INFO_IPHONE']='You should receive a missed call from us in next 60 seconds. Write received call number below:';
$dataLblArr['LBL_MOBILE_VERIFy_TXT']='Mobile Verification';
$dataLblArr['LBL_CALL_ME_TXT']='Call me';
$dataLblArr['LBL_DID_NOT_RECEIVE_CALL_TXT']='Did not receive a call?';
$dataLblArr['LBL_VERIFY_MOBILE_ALERT_TXT']='System will call you in order to verify mobile number.';
$dataLblArr['LBL_CARD']='Card';
$dataLblArr['LBL_YOUR_TRIP']='Your Trip';
$dataLblArr['LBL_HINT_TAP_TXT']='Tap anywhere to accept.';
$dataLblArr['LBL_LOAD_ADDRESS']='Loading address';
$dataLblArr['LBL_DISCOUNT']='Discount';
$dataLblArr['LBL_DRIVER_ARRIVED_TXT']='Driver Arrived';
$dataLblArr['LBL_ACC_DELETE_TXT']='Your account seems to be deleted. Please contact administrator.';
$dataLblArr['LBL_WRONG_DETAIL']='Your email or password is incorrect.';
$dataLblArr['LBL_READ_MORE']='Read More';
$dataLblArr['LBL_FEATURE']='FEATURES';
$dataLblArr['LBL_COMPANY_APP']='THE COMPANY APP';
$dataLblArr['LBL_HOME_NOTE1']='Request, ride and pay via your mobile phone';
$dataLblArr['LBL_EXPLORE_CITY']='Explore Your City Now';
$dataLblArr['LBL_FIND_MORE']='Find out more';
$dataLblArr['LBL_VIEW_MORE']='VIEW MORE';
$dataLblArr['LBL_FACEBOOK_PAGE']='Facebook Page';
$dataLblArr['LBL_SIGN_UP']='SIGN UP';
$dataLblArr['LBL_LOGIN_RIDER']='LOGIN AS RIDER';
$dataLblArr['LBL_LOGIN_DRIVER']='LOGIN AS DRIVER';
$dataLblArr['LBL_PAYPAL_DISABLE_TXT']='Paypal payment is disabled.';
$dataLblArr['LBL_CURRENCY_TXT']='Currency';
$dataLblArr['LBL_LANGUAGE_TXT']='Language';
$dataLblArr['LBL_USING_COMPANY']='USING COMPANYNAME';
$dataLblArr['LBL_OUR_COMPANY']='OUR COMPANY';
$dataLblArr['LBL_ADDRESS']='ADDRESS';
$dataLblArr['LBL_BLOGS']='BLOGS';
$dataLblArr['LBL_PLATFORM_FEE_TXT']='Platform Fee';
$dataLblArr['LBL_DRIVER']='Driver';
$dataLblArr['LBL_SIGN_NOTE1']='Find everything you need to track your success on the road.';
$dataLblArr['LBL_SIGN_NOTE2']='Manage your payment options, review trip history, and more.';
$dataLblArr['LBL_NO_CARS_NOTE_1_TXT']='No car available in';
$dataLblArr['LBL_NO_CARS_NOTE_2_TXT']='Please try again by changing the car category options given below';
$dataLblArr['LBL_DRIVER_ARRIVING_TXT']='Driver arriving';
$dataLblArr['LBL_PAYMENT_TYPE_TXT']='Payment type';
$dataLblArr['HOME_SECOND_LBL']='By Travelling in style to your destination';
$dataLblArr['LBL_ADD_PICKUP_LOC']='Add PickUp Location';
$dataLblArr['LBL_ADD_LOC']='Add Location';
$dataLblArr['LBL_SINCE_IT_IS_DEMO']='Since it is demo, Your account will expire after 7 days from registration';
$dataLblArr['LBL_LOGIN']='Login';
$dataLblArr['LBL_DONT_HAVE_ACCOUNT']='Don\'t have an account?';
$dataLblArr['LBL_TRIPS']='My Trips';
$dataLblArr['LBL_REGISTER_WITH_ONE_CLICK']='Register with one click:';
$dataLblArr['LBL_SIGN_UP_WITH_FACEBOOK']='Sign up with Facebook';
$dataLblArr['LBL_VEHICLES']='My Taxi\'s';
$dataLblArr['LBL_PLEASE_USE_BELOW']='Please use below info for viewing the Standard Passenger Panel Demo.';
$dataLblArr['LBL_IF_YOU_HAVE_REGISTER']='If you have registered as a new Passenger, use your Email Id and Password to view the detail of rides you have made.';
$dataLblArr['LBL_USERNAME']='rider@gmail.com';
$dataLblArr['LBL_PLEASE_USE_BELOW_DRIVER']='Please use below info for viewing the Standard Driver Panel Demo.';
$dataLblArr['LBL_PASSWORD']='Password';
$dataLblArr['LBL_IF_YOU_HAVE_REGISTER_DRIVER']='If you have registered as a new driver, use your Email Id and Password to view the detail of rides you have made.';
$dataLblArr['LBL_USERNAME_DRIVER']='driver@gmail.com';
$dataLblArr['LBL_PLEASE_USE_BELOW_DEMO']='Please use below info for viewing the Standard Company Panel Demo.';
$dataLblArr['LBL_IF_YOU_HAVE_REGISTER_COMPANY']='If you have registered as a new Company, use your Email Id and Password to view the detail of rides you have made.';
$dataLblArr['LBL_USERNAME_COMPANY']='company@gmail.com';
$dataLblArr['LBL_WE_SEE_YOU_HAVE_REGISTERED_AS_A_COMPANY']='We see you have registered as a company.';
$dataLblArr['LBL_SINCE_IT_IS_DEMO_VERSION']='Since this is a Demo Version, Uploading of document is not required. You just have to follow below steps.';
$dataLblArr['LBL_STEP1']='Step1: Add Driver';
$dataLblArr['LBL_STEP2']='Step2: Add vehicle under that driver';
$dataLblArr['LBL_STEP3']='Step2: Login in the App using that driver and become online.';
$dataLblArr['LBL_HOWEVER_IN_REAL_SYSTEM']='However in real system, a company will need to upload the documents and get the account validated in-order to use the app.';
$dataLblArr['LBL_SIGN_UP_TO_RIDE']='Sign up to Ride';
$dataLblArr['LBL_BECOME_A_DRIVER']='become a driver';
$dataLblArr['LBL_KINDLY_PROVIDE_BELOW']='Kindly provide below listed documents to validate your account.';
$dataLblArr['LBL_ALSO_ADD_DRIVERS']='Also, Add Drivers from the \"Driver\" module. Auto emails with be sent to the newly Added Drivers with their Registration detail once you have added them.';
$dataLblArr['LBL_EITHER_YOU_AS_A_COMPANY_DRIVER']='Either you as a Company can upload the Driver\'s Documents or the Drivers can login into their account and upload the documents from their Panel so that their account can be validated. And they can be visible on the App as an available Driver.';
$dataLblArr['LBL_WE_SEE_YOU_HAVE_REGISTERED_AS_A_DRIVER']='Thanks for registering as an individual driver.';
$dataLblArr['LBL_SINCE_IT_IS_DEMO_VERSION_ADDVEHICLE']='Since this is a Demo Version, Uploading of document is not required. You just have to go online and be available on App to accept a ride. Kindly login in the App and become online.';
$dataLblArr['LBL_HOWEVER_IN_REAL_SYSTEM_DRIVER']='However in real system, a Driver will need to uplaod documents and get the account validated in-order to be visible on the App as an available Driver.';
$dataLblArr['LBL_KINDLY_PROVIDE_BELOW_VISIBLE']='Kindly provide below documents to validate your account as a driver.';
$dataLblArr['LBL_EDIT_DELETE_RECORD']='\"Edit / Delete Record Feature\" has been disabled on the Demo Admin Panel. This feature will be enabled on the main script we will provide you.';
$dataLblArr['LBL_LICENCE_UPLOADED']='Licence is Uploaded.';
$dataLblArr['LBL_LICENCE_MISING']='Licence is missing.';
$dataLblArr['LBL_HOW_IT_WORKS']='How it Work';
$dataLblArr['LBL_EDIT']='Edit';
$dataLblArr['LBL_SAFETY_AND_INSURANCE']='Trust Safety & Insurance';
$dataLblArr['LBL_CERTIFICATION_UPLOADED']='Cerification is Uploaded.';
$dataLblArr['LBL_TERMS_AND_CONDITION']='Terms & Condition';
$dataLblArr['LBL_CERTIFICATION_MISSING']='Cerification is missing.';
$dataLblArr['LBL_NOC_UPLOADED']='NOC is Uploaded.';
$dataLblArr['LBL_MISSING']='NOC is missing.';
$dataLblArr['LBL_DOCUMENTS']='Documents';
$dataLblArr['LBL_YOUR_DRIVING_LICENCE']='Your Driving Licence';
$dataLblArr['LBL_LICENCE_FILE']='Licence File';
$dataLblArr['LBL_LICENCE_NOT_FOUND']='Licence not found';
$dataLblArr['LBL_CHANGE_LICENCE']='Change Licence';
$dataLblArr['LBL_YOUR_NOC']='Your Noc';
$dataLblArr['LBL_NOC_FILE']='NOC File';
$dataLblArr['LBL_NEED_TO_UPLOAD']='Need to upload';
$dataLblArr['LBL_CHANG_NOC']='Change Noc';
$dataLblArr['LBL_VERIFICATION_CERTIFICATE']='Verification Certificate';
$dataLblArr['LBL_CHANGE_CERTIFICATE']='Change Certificate';
$dataLblArr['LBL_HELP_CENTER']='Help Center';
$dataLblArr['LBL_LEGAL']='Legal';
$dataLblArr['LBL_DRIVER_LICENCE']='Driver Licence';
$dataLblArr['LBL_LICENCE_IMAGE']='License Image';
$dataLblArr['LBL_UPLOADE_LICENCE']='Upload License';
$dataLblArr['LBL_CHANGE']='Change';
$dataLblArr['LBL_NOC']='NOC';
$dataLblArr['LBL_LOGOUT']='Logout';
$dataLblArr['LBL_NO_CARD_AVAIL_NOTE']='No Card Available. Please add your card to use card payment.';
$dataLblArr['LBL_HOME']='Home';
$dataLblArr['LBL_PASSWORD']='Password';
$dataLblArr['LBL_NOC_IMAGE']='NOC Image';
$dataLblArr['LBL_UPLOAD_NOC']='Upload NOC';
$dataLblArr['LBL_PROFILE_PICTURE']='Profile Picture';
$dataLblArr['LBL_PROFILE_PHOTO']='Profile Photo';
$dataLblArr['LBL_UPLOAD_PHOTO']='Upload Photo';
$dataLblArr['LBL_POLICE_VARIFICATION_CERTIFICATE']='Police Verification Certificate';
$dataLblArr['LBL_CERTIFICATE_IMAGE']='Certificate Image';
$dataLblArr['LBL_UPLOAD_CERTIFICATE']='Upload Certificate';
$dataLblArr['LBL_NOTE_FOR_DEMO']='Note for Demo';
$dataLblArr['LBL_ADD_YOUR_CAR']='Add Your Taxi';
$dataLblArr['LBL_SINCE_THIS']='Since this is a Demo Version, Uploading of Vehicle document is not required';
$dataLblArr['LBL_DELETE']='Delete';
$dataLblArr['LBL_PLESE_UPLOAD_INSURENCE_DOCUMENT']='Please Upload Insurance Documents';
$dataLblArr['LBL_PLESE_UPLOAD_PERMIT_DOCUMENTS']='Please Upload Permit documents';
$dataLblArr['LBL_PLESE_UPLODEREGISTRATION_DOCUMENTS']='Please Upload Registration Documents';
$dataLblArr['LBL_VEHICAL_INSURENCE']='Vehicle Insurance';
$dataLblArr['LBL_INSURENCE_DOC']='Insurance Doc';
$dataLblArr['LBL_INSURENCE_IMAGE']='Insurance Image';
$dataLblArr['LBL_CHANGE_INSURENCE']='Change Insurance';
$dataLblArr['LBL_PERMIT']='Permit';
$dataLblArr['LBL_PERMIT_DOC']='Permit Doc';
$dataLblArr['LBL_PERMIT-IMAGE']='Permit Image';
$dataLblArr['LBL_CHANGE_PERMIT']='Change Permit';
$dataLblArr['LBL_REGISTRATION']='Registration';
$dataLblArr['LBL_CHANGE_REGISTRATION']='Change Registration';
$dataLblArr['LBL_Today']='Today';
$dataLblArr['LBL_Yesterday']='Yesterday';
$dataLblArr['LBL_Current_Week']='Current Week';
$dataLblArr['LBL_Previous_Week']='Previous Week';
$dataLblArr['LBL_Current_Month']='Current Month';
$dataLblArr['LBL_Previous Month']='Previous Month';
$dataLblArr['LBL_Current_Year']='Current Year';
$dataLblArr['LBL_Previous_Year']='Previous Year';
$dataLblArr['LBL_Search']='Search';
$dataLblArr['LBL_Pick_Up']='Pick Up';
$dataLblArr['LBL_Car']='Car';
$dataLblArr['LBL_View_Invoice']='View Invoice';
$dataLblArr['LBL_edit_delete']='�Edit / Delete Record Feature�';
$dataLblArr['LBL_From']='From';
$dataLblArr['LBL_To']='To';
$dataLblArr['LBL_Commission']='Commission';
$dataLblArr['LBL_Status']='Status';
$dataLblArr['LBL_Send_transfer_Request']='Send transfer Request';
$dataLblArr['LBL_TRANSFER_REQUEST_SEND']='Transfer Request Send';
$dataLblArr['LBL_TRANSFER_REQUEST_YET_PANDING']='Transfer Request Yet Pending';
$dataLblArr['LBL_CONTACT_US_SECOND_TXT']='the easiest to get around at the tap of a button';
$dataLblArr['LBL_WELCOME_TO']='Welcome to';
$dataLblArr['LBL_Your_Fare']='Your Fare';
$dataLblArr['LBL_CONTACT_US_TXT']='Contact Us';
$dataLblArr['LBL_WEBSITE_DESIGN_AND_DEVELOPED_BY']='Website Design & Developed by';
$dataLblArr['LBL_PROFILE_UPDATED']='Profile Updated succesfully';
$dataLblArr['LBL_SELECT_CONTRY']='Select Country';
$dataLblArr['LBL_SELECT_CURRENCY']='Select Currency';
$dataLblArr['LBL_PHONE']='Phone';
$dataLblArr['LBL_SIGN_UP_TODAY']='Sign Up Today';
$dataLblArr['LBL_TELL_US_A_BIT_ABOUT_YOURSELF']='Tell us a bit about yourself';
$dataLblArr['LBL_Contact_Info']='Contact Info';
$dataLblArr['LBL_IF_YOU_ARE_AN_INDIVIDUAL']='If you are an Individual Driver, please register as a Driver.';
$dataLblArr['LBL_IF_YOU_ARE_A_COMPANY']='If you are a Company and have more than 1 drivers working for you, please register as a Company and then add Drivers from your Company Dashboard.';
$dataLblArr['LBL_ARE_YOU_AN_INDIVIDUAL']='Are you an Individual Driver or a Company having more than one Drivers?';
$dataLblArr['LBL_Member_Type:']='Member Type:';
$dataLblArr['LBL_Individual_Driver']='Individual Driver';
$dataLblArr['LBL_Company']='Company';
$dataLblArr['LBL_CREATE_ACCOUNT']='Create an Account';
$dataLblArr['LBL_EMAIL_name@email.com']='name@email.com';
$dataLblArr['LLB_PASSWORD_Password: At least 5 characters']='Password: At least 6 characters';
$dataLblArr['LBL_777-777-7777']='Phone Number';
$dataLblArr['LBL_Company_Information']='Company Information';
$dataLblArr['LBL_Driver_Information']='Driver Information';
$dataLblArr['LBL_Company_name']='company name';
$dataLblArr['LBL_City']='City';
$dataLblArr['LBL_ZIP_CODE']='ZIP CODE';
$dataLblArr['LBL_Date_of_Birth']='Date of Birth';
$dataLblArr['LBL_Agree_to']='Agree to';
$dataLblArr['LBL_Recover_Password']='Recover Password';
$dataLblArr['LBL_YOUR_EMAIL_ID']='YOUR EMAIL ID';
$dataLblArr['LBL_YOUR_FIRST_NAME']='First Name';
$dataLblArr['LBL_YOUR_LAST_NAME']='Last Name';
$dataLblArr['LBL_Phone_Number']='Phone Number';
$dataLblArr['LBL_Save']='Save';
$dataLblArr['LBL_PROFILE_ADDRESS2']='Address 2';
$dataLblArr['LBL_Confirm_New_Password']='Confirm New Password';
$dataLblArr['LBL_Save_Documents']='Save Documents';
$dataLblArr['LBL_Vehicle']='Taxi';
$dataLblArr['LBL-back_to_listing']='back to listing';
$dataLblArr['LBL_Record_Updated_successfully.']='Record Updated successfully.';
$dataLblArr['LBL_CHOOSE_MAKE']='Select Make';
$dataLblArr['LBL_CHOOSE_VEHICLE_MODEL']='Select Vehicle Model';
$dataLblArr['LBL_CHOOSE_YEAR']='Select Year';
$dataLblArr['LBL_CHOOSE_DRIVER']='Select Driver';
$dataLblArr['LBL_Car_Type']='Car Type';
$dataLblArr['LBL_remember']='remember';
$dataLblArr['LBL_Invoice']='Invoice';
$dataLblArr['LBL_You_ride_with']='You ride with';
$dataLblArr['LBL_Rate_Your_Ride']='Rate Your Ride';
$dataLblArr['LBL_Basic_Fare']='Basic Fare';
$dataLblArr['LBL_Commision']='Commision';
$dataLblArr['LBL_Total_Fare']='Total Fare';
$dataLblArr['LBL_Trip_time']='Trip time';
$dataLblArr['LBL_Document_of']='Document of';
$dataLblArr['LBL_NOC_DOC']='NOC DOC';
$dataLblArr['LBL_Verification_Certi_Image']='Verification Certi Image';
$dataLblArr['LBL_FACEBOOK']='Facebook';
$dataLblArr['LBL_MY_BOOKINGS']='My Bookings';
$dataLblArr['LBL_UPDATE']='Update';
$dataLblArr['LBL_ENTER_PROMO']='Please enter PromoCode to get discount.';
$dataLblArr['LBL_PROMO_REMOVED']='Your applied PromoCode is removed.';
$dataLblArr['LBL_PROMO_INVALIED']='Invalid PromoCode.';
$dataLblArr['LBL_PROMO_APPLIED']='Promocode applied successfully.';
$dataLblArr['LBL_PROMO_USED']='You have already used this PromoCode.';
$dataLblArr['LBL_PROMO_CODE_ENTER_TITLE']='Enter Promo code';
$dataLblArr['LBL_GOOGLE_DIR_NO_ROUTE']='No driving routes found. Please enter a different location or try again.';
$dataLblArr['LBL_CHOOSE_CATEGORY']='Choose Category';
$dataLblArr['LBL_RIDE_HISTORY']='Ride History';
$dataLblArr['LBL_BOOKING_NO']='No';
$dataLblArr['LBL_FAQ_NOT_AVAIL']='FAQ\'s not available';
$dataLblArr['LBL_RATING']='Rating';
$dataLblArr['LBL_PROMO_DISCOUNT_TITLE']='PromoCode discount';
$dataLblArr['LBL_PREFIX_TRIP_CANCEL_DRIVER']='Oops! The trip has been cancelled by the driver. Reason :';
$dataLblArr['LBL_REQUEST_FAILED_PROCESS']='Sorry, we couldn\'t complete your request. Please try again later.';
$dataLblArr['LBL_SLIDE_UP_DETAIL']='SLIDE UP FOR DETAILS';
$dataLblArr['LBL_DEST_ADD_BY_DRIVER']='Driver has added the destination.';
$dataLblArr['LBL_FAQs']='Faq';
$dataLblArr['LBL_RESEND_SMS']='Resend SMS';
$dataLblArr['LBL_EDIT_MOBILE']='Edit Number';
$dataLblArr['LBL_SMS_SENT_TO']='Sms sent to';
$dataLblArr['LBL_VERIFY_MOBILE_CONFIRM_MSG']='We will verify your mobile number. Do you want to continue?';
$dataLblArr['LBL_VERIFICATION_CODE_INVALID']='You have entered invalid code.';
$dataLblArr['LBL_SIGNUP_BANNER_DRIVER']='The registration is done via driver\'s web panel please click on below button to proceed ahead with registration process';
$dataLblArr['LBL_ONLINE']='Online';
$dataLblArr['LBL_OFFLINE']='Offline';
$dataLblArr['LBL_CHOOSE_CAR']='Select car';
$dataLblArr['LBL_VIEW_PASSENGER_DETAIL']='View Passenger Detail';
$dataLblArr['LBL_CANCEL_TRIP']='Cancel Trip';
$dataLblArr['LBL_PICK_UP_PASSENGER']='Pick Up Passenger';
$dataLblArr['LBL_COLLECT_PAYMENT']='COLLECT PAYMENT';
$dataLblArr['LBL_PASSENGER_DETAIL']='Passenger Detail';
$dataLblArr['LBL_REASON']='Reason';
$dataLblArr['LBL_ENTER_REASON']='Enter your reason';
$dataLblArr['LBL_COLLECT_MONEY_FRM_RIDER']='Please collect money from rider';
$dataLblArr['LBL_PROMO_DIS_APPLIED_PREFIX']='PromoCode discount applied';
$dataLblArr['LBL_CARD_PAYMENT_DETAILS']='Card Details';
$dataLblArr['LBL_PAYMENT']='Payment';
$dataLblArr['LBL_ADD_CARD']='Add Card';
$dataLblArr['LBL_INVALID']='Invalid';
$dataLblArr['LBL_CHANGE_CARD']='Change Card';
$dataLblArr['LBL_TITLE_PAYMENT_ALERT']='Below card will be charged:';
$dataLblArr['LBL_INVALID_CARD']='Your card is invalid.';
$dataLblArr['LBL_CHARGE_COLLECT_FAILED']='Charge collection failed. Please try again or collect cash from passenger.';
$dataLblArr['LBL_COLLECT_CASH']='Collect Cash';
$dataLblArr['LBL_DAILY_EARNING']='Daily Earnings';
$dataLblArr['LBL_COMPLETED_TRIPS']='Completed Trips';
$dataLblArr['LBL_AVG_RATING']='Avg. Rating';
$dataLblArr['LBL_DETAILS']='Details';
$dataLblArr['LBL_TRIP_EARNING']='Trip Earning';
$dataLblArr['LBL_CARD_PAYMENT']='Card Payment';
$dataLblArr['LBL_RIDER_FEEDBACK']='Rider Feedback';
$dataLblArr['LBL_NO_FEEDBACK']='No feedback to display.';
$dataLblArr['LBL_YOUR_BILL']='Your Bill';
$dataLblArr['LBL_DIS_APPLIED']='discount applied';
$dataLblArr['LBL_HOW_WAS_RIDE']='How was your ride?';
$dataLblArr['LBL_DIS_ALLOW_EDIT_CARD']='Since your ride is going on, you are not allow to change card information.';
$dataLblArr['LBL_HEADER_PROFILE_TXT']='Profile';
$dataLblArr['LBL_HEADER_TRIPS_TXT']='Trips';
$dataLblArr['LBL_FARE_BREAKDOWN_TXT']='Fare Breakdown';
$dataLblArr['LBL_DRIVER_COMPANY_TXT']='Driver';
$dataLblArr['LBL_ADD_DRIVER_COMPANY_TXT']='ADD DRIVER';
$dataLblArr['LBL_SHORT_LANG_TXT']='Lang';
$dataLblArr['LBL_EDIT_DOCUMENTS_TXT']='Edit Document';
$dataLblArr['LBL_BACK_MY_TAXI_LISTING']='back to my taxi listing';
$dataLblArr['LBL_DRIVER_ARRIVING_NOTIFICATION']='Driver has started for pickup.';
$dataLblArr['LBL_CANCEL_TXT_1']='No need to worry.You can request a new pickup.';
$dataLblArr['LBL_HOMPAGE_HELP_CITY']='For the good of all';
$dataLblArr['LBL_HOMEPAGE_HELP_CITY_LINK']='our Local impact';
$dataLblArr['LBL_HOMEPAGE1_LINK']='more reasons to ride';
$dataLblArr['LBL_HOMEPAGE2_H2']='They�re people like you, going your way.';
$dataLblArr['LBL_HOMEPAGE2_LINK']='why drive with uber clone';
$dataLblArr['LBL_HOMEPAGE4_H2']='Putting people first.';
$dataLblArr['LBL_HOMEPAGE4_LINK']='How we keep you safe';
$dataLblArr['LBL_ADD_DEST_MSG_BOOK_RIDE']='Please add your destination location to book your ride.';
$dataLblArr['LBL_CANCEL_TRIP_BY_DRIVER_MSG_SUFFIX']='No need to worry.You can request a new pickup.';
$dataLblArr['LBL_LICENCE_PLATE_EXIST']='Licence Plate Already Exist.';
$dataLblArr['LBL_BTN_REGISTER_NOW_TXT']='Register Now';
$dataLblArr['LBL_UPDATE_NOC']='Update NOC';
$dataLblArr['LBL_UPDATE_LICENCE']='Update Licence';
$dataLblArr['LBL_UPDATE_CERTI']='Update Certificate';
$dataLblArr['LBL_REQUIRED_DOCS']='Required Documents';
$dataLblArr['LBL_LANGUAGE_SELECT']='SELECT YOUR LANGUAGE';
$dataLblArr['LBL_LANG_NOT_FIND']='Can\'t find your language? Contact Us';
$dataLblArr['LBL_MY_EARN']='My Earnings';
$dataLblArr['LBL_HOMEPAGE1_H2']='Tap, Ride, Tap - That is all there is to it.';
$dataLblArr['LBL_NEW_UPDATE_AVAIL']='New update available!';
$dataLblArr['LBL_BTN_PROFILE_CANCEL_TRIP_TXT']='Cancel';
$dataLblArr['LBL_BTN_PROFILE_RIDER_CANCEL_TRIP_TXT']='Cancel';
$dataLblArr['LBL_PROFILE_YOUR_EMAIL_ID']='Enter Your Email Id';
$dataLblArr['LBL_PROFILE_RIDER_YOUR_EMAIL_ID']='Your Email ID';
$dataLblArr['LBL_ADD_NOC']='Add NOC';
$dataLblArr['LBL_PROFILE_Company_name']='Company name';
$dataLblArr['LBL_PROFILE_Company']='Company';
$dataLblArr['LBL_BTN_CONTECT_US_SUBMIT_TXT']='Submit';
$dataLblArr['LBL_BTN_SIGN_UP_SUBMIT_TXT']='Submit';
$dataLblArr['LBL_CONTECT_US_LAST_NAME_HEADER_TXT']='Last Name';
$dataLblArr['LBL_SIGN_UP_LAST_NAME_HEADER_TXT']='Last Name';
$dataLblArr['LBL_CONTECT_US_FIRST_NAME_HEADER_TXT']='First Name';
$dataLblArr['LBL_SIGN_UP_FIRST_NAME_HEADER_TXT']='First Name';
$dataLblArr['LBL_SIGN_UP_CREATE_ACCOUNT']='Create an Account';
$dataLblArr['LBL_SIGN_UP_TELL_US_A_BIT_ABOUT_YOURSELF']='Tell us a bit about yourself';
$dataLblArr['LBL_SIGN_UP_SIGN_UP_TODAY']='Sign Up Today';
$dataLblArr['LBL_FOOTER_HOME_HELP_CENTER']='Help Center';
$dataLblArr['LBL_FOOTER_HOME_CONTACT_US_TXT']='Contact Us';
$dataLblArr['LBL_SIGN_UP_TERMS_AND_CONDITION']='Terms & Condition';
$dataLblArr['LBL_COMPANY_TRIP_Car']='Car';
$dataLblArr['LBL_INVOICE_Car']='Car';
$dataLblArr['LBL_MYTRIP_Car']='Car';
$dataLblArr['LBL_RIDER_INVOICE_Car']='Car';
$dataLblArr['LBL_COMPANY_TRIP_DRIVER']='Driver';
$dataLblArr['LBL_DRIVER_DRIVER']='Driver';
$dataLblArr['LBL_MYTRIP_DRIVER']='Driver';
$dataLblArr['LBL_EMERGENCY_CONTACT']='Emergency Contact';
$dataLblArr['LBL_HEADER_TOPBAR_DRIVER']='Driver';
$dataLblArr['LBL_DRIVER_EMAIL_LBL_TXT']='Email';
$dataLblArr['LBL_PROFILE_RIDER_EMAIL_LBL_TXT']='Email';
$dataLblArr['LBL_CONTECT_US_EMAIL_LBL_TXT']='Email';
$dataLblArr['LBL_PAYMENT_REQUEST_PAYMENT']='Payment Request';
$dataLblArr['LBL_COMPANY_TRIP_View_Invoice']='View Invoice';
$dataLblArr['LBL_MYTRIP_View_Invoice']='View Invoice';
$dataLblArr['LBL_COMPANY_TRIP_Car_Type']='Car Type';
$dataLblArr['LBL_COMPANY_TRIP_FARE_TXT']='Fare';
$dataLblArr['LBL_DRIVER_TRIP_FARE_TXT']='Fare';
$dataLblArr['LBL_COMPANY_TRIP_Trip_Date']='Trip Date';
$dataLblArr['LBL_MYTRIP_Trip_Date']='Trip Date';
$dataLblArr['LBL_COMPANY_TRIP_RIDER']='Rider';
$dataLblArr['LBL_MYTRIP_RIDE_NO']='Ride No.';
$dataLblArr['LBL_DRIVER_TRIP_Search']='Search';
$dataLblArr['LBL_COMPANY_TRIP_Search']='Search';
$dataLblArr['LBL_COMPANY_TRIP_Previous_Year']='Previous Year';
$dataLblArr['LBL_EMERGENCY_CONTACT_TITLE']='Make your travel safe';
$dataLblArr['LBL_MYTRIP_Previous_Year']='Previous Year';
$dataLblArr['LBL_COMAPNY_TRIP_Current_Year']='Current Year';
$dataLblArr['LBL_MYTRIP_Current_Year']='Current Year';
$dataLblArr['LBL_COMPANY_TRIP_Previous Month']='Previous Month';
$dataLblArr['LBL_MYTRIP_Previous Month']='Previous Month';
$dataLblArr['LBL_MYTRIP_Current_Month']='Current Month';
$dataLblArr['LBL_COMPANY_TRIP_Current_Month']='Current Month';
$dataLblArr['LBL_COMPANY_TRIP_Previous_Week']='Previous Week';
$dataLblArr['LBL_MYTRIP_Previous_Week']='Previous Week';
$dataLblArr['LBL_EMERGENCY_CONTACT_SUB_TITLE']='Send alert to your friends/family members in case of an emergency. Please add them to your emergency contacts.';
$dataLblArr['LBL_MYTRIP_Current_Week']='Current Week';
$dataLblArr['LBL_COMPANY_TRIP_Current_Week']='Current Week';
$dataLblArr['LBL_COMPANY_TRIP_Today']='Today';
$dataLblArr['LBL_MYTRIP_Today']='Today';
$dataLblArr['LBL_MYTRIP_Yesterday']='Yesterday';
$dataLblArr['LBL_COMPANY_TRIP_Yesterday']='Yesterday';
$dataLblArr['LBL_ADD_EMERGENCY_UP_TO_COUNT']='You can add up to 5 contacts';
$dataLblArr['LBL_ADD_CONTACTS']='Add Contacts';
$dataLblArr['LBL_COMPANY_TRIP_SEARCH_RIDES_POSTED_BY_TIME_PERIOD']='Search Rides by Time period...';
$dataLblArr['LBL_MYTRIP_SEARCH_RIDES_POSTED_BY_TIME_PERIOD']='Search Rides by Time period...';
$dataLblArr['LBL_COMPANY_TRIP_SEARCH_RIDES_POSTED_BY_DATE']='Search rides by date...';
$dataLblArr['LBL_MYTRIP_SEARCH_RIDES_POSTED_BY_DATE']='Search rides by date...';
$dataLblArr['LBL_COMPANY_TRIP_HEADER_TRIPS_TXT']='Trips';
$dataLblArr['LBL_DRIVER_DELETE']='Delete';
$dataLblArr['LBL_PROFILE_YOUR_NOC']='Your Noc';
$dataLblArr['LBL_PROFILE_VERIFICATION_CERTIFICATE']='Verification Certificate';
$dataLblArr['LBL_PROFILE_DRIVER_LICENCE']='Driver Licence';
$dataLblArr['LBL_PROFILE_ADDRESS']='ADDRESS';
$dataLblArr['LBL_DRIVER_EDIT']='Edit';
$dataLblArr['LBL_PROFILE_EDIT']='Edit';
$dataLblArr['LBL_VEHICLE_EDIT']='Edit';
$dataLblArr['LBL_LEFT_MENU_TRIPS']='My Trips';
$dataLblArr['LBL_HEADER_TOPBAR_VEHICLES']='My Taxi\'s';
$dataLblArr['LBL_LEFT_MENU_VEHICLES']='Vehicles';
$dataLblArr['LBL_HEADER_TOPBAR_MY_PROFILE_HEADER_TXT']='My Profile';
$dataLblArr['LBL_HEADER_TOPBAR_PROFILE_TITLE_TXT']='My Profile';
$dataLblArr['LBL_LEFT_MENU_LOGIN']='Login';
$dataLblArr['LBL_PROFILE_PASSWORD_LBL_TXT']='Password';
$dataLblArr['LBL_PROFILE_RIDER_PASSWORD']='123456';
$dataLblArr['LBL_PROFILE_RIDER_PASSWORD']='password';
$dataLblArr['LBL_LOGIN_NEW_SIGN_UP']='SIGN UP';
$dataLblArr['LBL_SIGN_UP_SIGN_UP']='SIGN UP';
$dataLblArr['LBL_HOME_SIGN_UP']='SIGN UP';
$dataLblArr['LBL_HEADER_BECOME_A_DRIVER']='become a driver';
$dataLblArr['LBL_HEADER_TOPBAR_BECOME_A_DRIVER']='become a driver';
$dataLblArr['LBL_HEADER_SIGN_UP_TO_RIDE']='Sign up to Ride';
$dataLblArr['LBL_HEADER_TOPBAR_SIGN_UP_TO_RIDE']='Sign up to Ride';
$dataLblArr['LBL_HEADER_TOPBAR_SIGN_IN_TXT']='Sign In';
$dataLblArr['LBL_SIGN_IN_SIGN_IN_TXT']='SIGN IN';
$dataLblArr['LBL_EME_CONTACT_LIST_UPDATE']='Your emergency contacts has been updated.';
$dataLblArr['LBL_CONFIRM_MSG_DELETE_EME_CONTACT']='Are you sure, you want to delete this emergency contact?';
$dataLblArr['LBL_CONFIRM_EME_PAGE_TITLE']='USE IN CASE OF EMERGENCY';
$dataLblArr['LBL_CALL_POLICE']='Call Police Control Room';
$dataLblArr['LBL_SEND_ALERT_EME_CONTACT']='Send message to your emergency contacts.';
$dataLblArr['LBL_ADD_EME_CONTACTS']='You don\'t have any emergency contact. Please add emergency contacts.';
$dataLblArr['LBL_EME_CONTACT_ALERT_SENT']='Alert sent to your emergency contacts.';
$dataLblArr['LBL_EME_CONTACT_EXIST']='Emergency Contact already exist.';
$dataLblArr['LBL_TRIP_RATING_FINISHED_TXT']='Thanks for providing your Ratings/Reviews.';
$dataLblArr['LBL_CONFIRM_BOOKING']='Confirm Booking';
$dataLblArr['LBL_RIDE_NOW']='Ride Now';
$dataLblArr['LBL_RIDE_LATER']='Ride Later';
$dataLblArr['LBL_INVALID_PICKUP_TIME']='Invalid pickup time';
$dataLblArr['LBL_INVALID_PICKUP_NOTE_MSG']='Please make sure that pickup time is after atleast an hour from now.';
$dataLblArr['LBL_RIDE_BOOKED']='You ride is successfully booked.';
$dataLblArr['LBL_NO_BOOKINGS_AVAIL']='No bookings available.';
$dataLblArr['LBL_BOOKING_CANCELED']='Your booking is successfully cancelled.';
$dataLblArr['LBL_CANCEL_BOOKING']='Cancel Booking';
$dataLblArr['LBL_ASSIGNED']='Assigned';
$dataLblArr['LBL_CANCELLED']='Cancelled';
$dataLblArr['LBL_CANCELLED_BY_DRIVER']='Cancelled by driver';
$dataLblArr['LBL_START_TRIP']='Start trip';
$dataLblArr['LBL_BOOKING_DATE']='Booking Date';
$dataLblArr['LBL_ADD_REASON_CANCEL_BOOKING']='Please add reason to cancel this booking.';
$dataLblArr['LBL_NOTIFY_RESTART_APP_TO_CHANGE']='In order to apply changes restarting app is required. Please wait.';
$dataLblArr['LBL_VIEW_BOOKINGS']='View Bookings';
$dataLblArr['LBL_OR_SIGN_IN_WITH']='Or Sign in with';
$dataLblArr['LBL_UPDATE_PLAY_SERVICE_NOTE']='This application requires updated google play service. Please install Or update it from play store';
$dataLblArr['LBL_ALLOW_PERMISSIONS_APP']='Application requires some permission to be granted to work. Please allow it.';
$dataLblArr['LBL_ENABLE_GPS']='Your GPS seems to be disabled, do you want to enable it?';
$dataLblArr['LBL_ERROR_NO_SPACE_IN_PASS']='Password should not contain whitespace.';
$dataLblArr['LBL_ERROR_PASS_LENGTH_PREFIX']='Password must be';
$dataLblArr['LBL_ERROR_PASS_LENGTH_SUFFIX']='or more character long.';
$dataLblArr['LBL_NOTE_NO_DRIVER_REQUEST']='Driver is not able to take your request. Please cancel request and try again OR retry.';
$dataLblArr['LBL_NAVIGATE']='Navigate';
$dataLblArr['LBL_DEST_ADD_BY_PASSENGER']='Destination is added by passenger';
$dataLblArr['LBL_ROUTE_DRAW_FAILED']='Route drawn failed';
$dataLblArr['LBL_SUNDAY']='SUN';
$dataLblArr['LBL_DONE']='Done';
$dataLblArr['LBL_MONDAY']='MON';
$dataLblArr['LBL_TUESDAY']='TUE';
$dataLblArr['LBL_WEDNESDAY']='WED';
$dataLblArr['LBL_THURESDAY']='THU';
$dataLblArr['LBL_FRIDAY']='FRI';
$dataLblArr['LBL_SATURDAY']='SAT';
$dataLblArr['LBL_RES_TO_CONTACT']='Reason to contact';
$dataLblArr['LBL_YOUR_QUERY']='Your Query';
$dataLblArr['LBL_RIDE']='Ride';
$dataLblArr['LBL_DELIVER']='Deliver';
$dataLblArr['LBL_SELECT_PICKUP_TYPE_HEADER']='Select your PickUp type';
$dataLblArr['LBL_DELIVERY_DETAILS']='Delivery Details';
$dataLblArr['LBL_RECEIVER_NAME']='Receiver Name';
$dataLblArr['LBL_RECEIVER_MOBILE']='Receiver Mobile';
$dataLblArr['LBL_PICK_UP_INS']='Pickup Instruction';
$dataLblArr['LBL_DELIVERY_INS']='Delivery Instruction';
$dataLblArr['LBL_PACKAGE_DETAILS']='Package Details';
$dataLblArr['LBL_SEND_REQ']='Send Request';
$dataLblArr['LBL_DELIVER_NOW']='Deliver Now';
$dataLblArr['LBL_DELIVER_LATER']='Deliver Later';
$dataLblArr['LBL_ADD_DEST_MSG_DELIVER_ITEM']='Please add your destination location to deliver your package.';
$dataLblArr['LBL_DELIVERY_BOOKED']='Your package delivery is schedule.';
$dataLblArr['LBL_SELECT_PACKAGE_TYPE']='Select package type';
$dataLblArr['LBL_PACKAGE_TYPE']='Package Type';
$dataLblArr['LBL_RIDE_TYPE']='Ride Type';
$dataLblArr['LBL_VIEW_DELIVERY_DETAILS']='View Delivery Details';
$dataLblArr['LBL_CANCEL_DELIVERY']='Cancel Delivery';
$dataLblArr['LBL_SENDER']='Sender';
$dataLblArr['LBL_RECIPIENT']='Recipient';
$dataLblArr['LBL_PICKUP_DELIVERY']='Pickup Delivery';
$dataLblArr['LBL_SLIDE_BEGIN_DELIVERY']='Slide to begin delivery';
$dataLblArr['LBL_SLIDE_END_DELIVERY']='Slide to end delivery';
$dataLblArr['LBL_DELIVERY_CONFIRM']='Delivery Confirmation';
$dataLblArr['LBL_INVALID_DELIVERY_CONFIRM_CODE']='Invalid code';
$dataLblArr['LBL_DELIVERY_END_NOTE']='Please enter the confirmation code received from recipient.';
$dataLblArr['LBL_DELIVERY_END_NOTE_DEMO']='For demo purpose, please enter confirmation code in text box as shown below.';
$dataLblArr['LBL_HOW_WAS_DELIVERY']='How was delivery?';
$dataLblArr['LBL_DELIVERY_END_MSG_TXT']='Your package has been successfully delivered.';
$dataLblArr['LBL_START_DELIVERY']='Start Delivery';
$dataLblArr['LBL_DELIVERY_NO']='No';
$dataLblArr['LBL_NO_DELIVERY_AVAIL']='No delivery available';
$dataLblArr['LBL_CONFIRMATION_CODE']='Confirmation Code';
$dataLblArr['LBL_PICK_SURGE_NOTE']='Peak time charges will be applied as per below';
$dataLblArr['LBL_NIGHT_SURGE_NOTE']='Night charges will be applied as per below';
$dataLblArr['LBL_PAYABLE_AMOUNT']='OF PAYABLE AMOUNT';
$dataLblArr['LBL_TRY_LATER']='TRY LATER';
$dataLblArr['LBL_ACCEPT_SURGE']='ACCEPT HIGHER PRICE';
$dataLblArr['LBL_SESSION_TIME_OUT']='Your session is expired. Please login again.';
$dataLblArr['LBL_REQUEST']='Request';
$dataLblArr['LBL_NO_DELIVERY_NOTE_1_TXT']='No delivery available in';
$dataLblArr['LBL_NO_DELIVERY_NOTE_2_TXT']='Please try again by changing the delivery category options given below';
$dataLblArr['LBL_DELIVERY']='Delivery';
$dataLblArr['LBL_ADD_REASON_TO_CANCEL_TRIP']='Please add reason to cancel trip.';
$dataLblArr['LBL_NEW_UPDATE_MSG']='New update is available to download. Downloading the latest update, you will get latest features, improvements and bug fixes.';
$dataLblArr['LBL_REFERAL_CODE']='Referral Code (Optional)';
$dataLblArr['LBL_RIDER_WALLET']='My Wallet';
$dataLblArr['LBL_SEARCH_TRANSACTION_BY_DATE']='Search By Date';
$dataLblArr['LBL_DESCRIPTION']='Description';
$dataLblArr['LBL_AMOUNT']='Amount';
$dataLblArr['LBL_BALANCE_TYPE']='Type';
$dataLblArr['LBL_BALANCE_FOR']='Balance For';
$dataLblArr['LBL_TRANSACTION_DATE']='Transaction Date';
$dataLblArr['LBL_BALANCE']='Balance';
$dataLblArr['LBL_ENTER_AMOUNT']='Enter Amount';
$dataLblArr['LBL_WITHDRAW_REQUEST']='Withdraw Request';
$dataLblArr['LBL_ADD_MONEY']='Add Money';
$dataLblArr['MY_REFERAL_CODE']='My Referral Code';
$dataLblArr['LBL_INVITE_CODE']='Referral / Invite Code';
$dataLblArr['LBL_INVITE_CODE_HINT']='Referral / Invite Code (Optional)';
$dataLblArr['LBL_INVITE_CODE_INVALID']='Invalid invite code';
$dataLblArr['LBL_INVITE_FRIEND_TXT']='Invite Friends';
$dataLblArr['LBL_INVITE_FRIEND_SHARE']='Share Your Invite Code';
$dataLblArr['LBL_INVITE_FRIEND_SHARE_TXT']='Invite your friends by sharing above invite code and earn the referral amount. ';
$dataLblArr['LBL_REFERAL_SCHEME']='Enter the referral code provided to you.Your friend will earn referral reward once you have taken a successful ride.';
$dataLblArr['LBL_LICENCE_NO_TXT']='Licence No';
$dataLblArr['SHARE_CONTENT']='Hello I am using projectName. It\'s an amazing app.Signup using below referral code and enjoy riding.';
$dataLblArr['LBL_FREE_RIDE']='Invite Friends';
$dataLblArr['LBL_REFERAL_SCHEME_TXT']='What is Referral / Invite Code ?';
$dataLblArr['LBL_Transaction_HISTORY']='Your Transactions';
$dataLblArr['LBL_VIEW_TRANS_HISTORY']='View Transactions';
$dataLblArr['LBL_USER_BALANCE']='Your Balance';
$dataLblArr['LBL_LEFT_MENU_WALLET']='My Wallet';
$dataLblArr['LBL_WALLET_DISCOUNT']='Wallet Discount';
$dataLblArr['LBL_NO_TRANSACTION_AVAIL']='No transaction available';
$dataLblArr['LBL_RECHARGE_AMOUNT_TXT']='Recharge Amount';
$dataLblArr['LBL_WITHDRAW_MONEY_TXT']='With Draw Money';
$dataLblArr['LBL_ADD_MONEY_TXT']='Add Money';
$dataLblArr['LBL_PRIVACY_POLICY']='By conducting you choose to accept projectName\'s';
$dataLblArr['LBL_PRIVACY_POLICY1']='Terms & Privacy Policy';
$dataLblArr['LBL_ADD_MONEY_TXT1']='It\'s safe n secure';
$dataLblArr['LBL_BANK_DETAILS_TXT']='Bank Details';
$dataLblArr['LBL_PAYMENT_EMAIL_TXT']='Payment Email';
$dataLblArr['LBL_ACCOUNT_HOLDER_NAME']='Account Holder Name';
$dataLblArr['LBL_ACCOUNT_NUMBER']='Account Number';
$dataLblArr['LBL_NAME_OF_BANK']='Name of Bank';
$dataLblArr['LBL_BANK_LOCATION']='Bank Location';
$dataLblArr['LBL_BIC_SWIFT_CODE']='BIC/SWIFT Code';
$dataLblArr['LBL_RESET']='Reset';
$dataLblArr['LBL_FARE_BREAKDOWN']='FARE BREAKDOWN';
$dataLblArr['LBL_PLATFORM_FREES_TXT']='Platform Fees';
$dataLblArr['LBL_CHARGED_TXT']='CHARGED';
$dataLblArr['LBL_DELIVERY_CONFIRMATION_CODE_TXT']='Delivery Confirmation Code';
$dataLblArr['LBL_TRIP_RATING_TXT']='TRIP RATING';
$dataLblArr['LBL_PAYMENT_RECEIPT_TXT']='Payment Receipt';
$dataLblArr['LBL_PET_DETAIL']='Pet Detail';
$dataLblArr['LBL_PET_NAME_TXT']='Pet Name';
$dataLblArr['LBL_CHOOSE_OPTION']='Choose Option';
$dataLblArr['LBL_CHOOSE_PET']='Choose Your Pet';
$dataLblArr['LBL_SCHEDULE_LATER']='Schedule Later';
$dataLblArr['LBL_REQUEST_NOW']='Request Now';
$dataLblArr['LBL_CONFIRM_MSG_DELETE_PET_DETAIL']='Are you sure, you want to delete this pet detail?';
$dataLblArr['LBL_SELECT_PET_TYPE']='Select Pet Type';
$dataLblArr['LBL_WEIGHT_TXT']='Weight';
$dataLblArr['LBL_BREED_TXT']='Breed';
$dataLblArr['LBL_ADD_PET_TXT_1']='ADD PET';
$dataLblArr['LBL_PET_NAME_HINT_TXT']='Enter Pet name';
$dataLblArr['LBL_ADD_PET']='ADD A PET';
$dataLblArr['LBL_MY_PET']='My Pets';
$dataLblArr['LBL_THRESHOLDAMOUNT_NOTE1']='*Your requested';
$dataLblArr['LBL_THRESHOLDAMOUNT_NOTE2']='Payment must be more than';
$dataLblArr['LBL_NOT_YOUR_DRIVER']='You can not edit another driver. Try again.';
$dataLblArr['LBL_SEND_REQUEST_SUCCESSFULLY']='Transfer Request Send Successfully To Admin.';
$dataLblArr['LBL_MINIMUM']='Minimum';
$dataLblArr['LBL_DO_NOT_CLOASE_APP']='Please do not close app.';
$dataLblArr['LBL_SUCCESS_UPDATE_CURRENCY']='Record Updated successfully.';
$dataLblArr['LBL_NOT_YOUR_DRIVER_DOCUMENT']='You can not edit another driver Document. Try again.';
$dataLblArr['LBL_TRIP_CANCEL_NOTIFICATION']='Trip cancelled';
$dataLblArr['LBL_CONFIRM_START_DELIVERY']='Are you sure? You want to start delivery.';
$dataLblArr['LBL_CONFIRM_END_DELIVERY']='Are you sure? You want to end delivery.';
$dataLblArr['LBL_EXP_DATE']='Exp. Date';
$dataLblArr['LBL_MIN_RES_IMAGE']='Please select image which has minimum is 256 * 256 resolution.';
$dataLblArr['LBL_PENDING']='Pending';
$dataLblArr['LBL_SET_LOCATION']='Please set location.';
$dataLblArr['LBL_HOME_PLACE']='Home Place';
$dataLblArr['LBL_WORK_PLACE']='Work Place';
$dataLblArr['LBL_WRONG_DATE']='Incorrect Date';
$dataLblArr['LBL_SOMETHING_WENT_WRONG']='Something went wrong. Please try again.';
$dataLblArr['LBL_COUNTRY_CODE']='Code';
$dataLblArr['LBL_NOC_NOT_FOUND']='NOC not found';
$dataLblArr['LBL_CERTIFICATE_NOT_FOUND']='Certificate not found';
$dataLblArr['LBL_ADD_DOCUMENT']='ADD';
$dataLblArr['LBL_WALLET_DEBIT_MONEY']='Wallet Balance Adjustment';
$dataLblArr['LBL_SURGE_MONEY']='Surge Money';
$dataLblArr['LBL_MAKE']='Make';
$dataLblArr['LBL_MODEL']='Model';
$dataLblArr['LBL_YEAR']='Year';
$dataLblArr['LBL_ADD_VEHICLE']='Add Taxi';
$dataLblArr['LBL_FARE_BREAKDOWN_RIDE_NO_TXT']='Fare Breakdown For Ride No';
$dataLblArr['LBL_Total_Fare_TXT']='Total Fare';
$dataLblArr['LBL_ON']='On';
$dataLblArr['LBL_OFF']='Off';
$dataLblArr['LBL_SELECT_CAR_TYPE']='You must select at least one car type';
$dataLblArr['LBL_ACCOUNT_VERIFY_ALERT_TXT']='To Go Online you must have to verify your Mobile/Email.';
$dataLblArr['LBL_ACCOUNT_VERIFY_TXT']='Account Verification';
$dataLblArr['LBL_RESEND_EMAIL']='Resend Email';
$dataLblArr['LBL_EDIT_EMAIL']='Edit Email';
$dataLblArr['LBL_EMAIL_VERIFICATION_FAILED_TXT']='Something went wrong while sending email. Please try again';
$dataLblArr['LBL_ACC_VERIFICATION_FAILED']='Account verification failed. Please try again.';
$dataLblArr['LBL_ENTER_VERIFICATION_CODE']='Please enter verification code.';
$dataLblArr['LBL_EMAIl_VERIFIED']='Email Verified Successfully.';
$dataLblArr['LBL_EMAIl_VERIFIED_ERROR']='Error-in Email Verification.';
$dataLblArr['LBL_PHONE_VERIFIED']='Your Phone is verified.';
$dataLblArr['LBL_PHONE_VERIFIED_ERROR']='Error-in Phone Verification.';
$dataLblArr['LBL_EDIT_PROFILE_BLOCK']='You can\'t edit your profile due to current active trip. Please try again once current trip is completed.';
$dataLblArr['LBL_EDIT_PROFILE_BLOCK_DRIVER']='You can\'t edit your profile while you are online to receive the trip requests. Please go offline and try again.';
$dataLblArr['LBL_WALLET_ADJUSTMENT']='Wallet adjustment';
$dataLblArr['LBL_SURGE']='Surge';
$dataLblArr['LBL_WALLET_MONEY_CREDITED_FAILED']='Failed to credit money.Please try again later.';
$dataLblArr['LBL_WALLET_MONEY_CREDITED']='Entered amount is successfully credited into your account';
$dataLblArr['LBL_NO_RECORDS_FOUND']='No Record Found';
$dataLblArr['LBL_INSURANCE_NOT_FOUND_TXT']='Insurance Not Found';
$dataLblArr['LBL_PERMIT_NOT_FOUND_TXT']='Permit Not Found';
$dataLblArr['LBL_REGISTRATION_NOT_FOUND_TXT']='Registration Not Found';
$dataLblArr['LBL_INSURANCE_UPLOADED_TXT']='Insurance is uploaded';
$dataLblArr['LBL_PERMIT_UPLOADED_TXT']='Permit is uploaded';
$dataLblArr['LBL_REGISTRATION_UPLOADED_TXT']='Registration is uploaded';
$dataLblArr['LBL_SURE_DELETE']='Delete?';
$dataLblArr['LBL_SURE_DEL_CAR_DETAIL']='Are you sure you want to delete car details?';
$dataLblArr['LBL_FAQ_TEXT']='FAQ';
$dataLblArr['LBL_ADD_CERTI']='Add Certificate';
$dataLblArr['LBL_ADD_LICENCE']='Add Licence';
$dataLblArr['LBL_EMAIL_SENT_TO']='Email sent to:';
$dataLblArr['LBL_DOC_UPDATE_INS']='Change Insurance';
$dataLblArr['LBL_DOC_ADD_INS']='Add Insurance';
$dataLblArr['LBL_DOC_UPDATE_PER']='Change Permit';
$dataLblArr['LBL_EMAIL_SENT_NOTE']='We have sent you the code on your registered email account. Please enter it below to verify.';
$dataLblArr['LBL_SMS_SENT_NOTE']='We have sent you the code on your mobile number. Please enter it below to verify.';
$dataLblArr['LBL_EMAIL_VERIFy_TXT']='Email Verification';
$dataLblArr['LBL_ENTER_EMAIL_VERIFICATION_CODE_TXT']='Enter Verification Code that you have received from email';
$dataLblArr['LBL_CERTIFICATE_FILE']='Certificate File';
$dataLblArr['LBL_DOC_ADD_PER']='Add Permit';
$dataLblArr['LBL_DOC_UPDATE_REG']='Change Registration';
$dataLblArr['LBL_DOC_ADD_REG']='Add Registration';
$dataLblArr['LBL_GET_STARTED']='Get Started';
$dataLblArr['LBL_HOME_DRIVER_COMPANY_TXT_LOGIN']='Driver Or company? The text to display in homepage after user login.';
$dataLblArr['LBL_HOME_RIDING_TXT_LOGIN']='The text to display in homepage after user login.';
$dataLblArr['LBL_REMOVE_TEXT']='Remove';
$dataLblArr['LBL_BACK_TAXI_LISTING']='back to taxi listing';
$dataLblArr['LBL_PAY_BY_CASH_TXT']='Pay by cash';
$dataLblArr['LBL_NORMAL_FARE']='Normal Fare';
$dataLblArr['LBL_PAY_BY_CARD_TXT']='Pay by credit/debit card';
$dataLblArr['LBL_CHANGE_CARD_TXT']='Change Card';
$dataLblArr['LBL_GIVE_TIP_TXT']='Give Tip';
$dataLblArr['LBL_CONTINUE_TRIP_TXT']='Continue trip';
$dataLblArr['LBL_CANCEL_TRIP_NOW']='Cancel Trip Now';
$dataLblArr['LBL_MENU_MY_HEATVIEW']='Heat View';
$dataLblArr['LBL_DRIVER_ARRIVED_NOTIFICATION']='Driver has arrived';
$dataLblArr['LBL_ACCOUNT_VERIFY_ALERT_RIDER_TXT']='To Request a Pick Up you must have to verify your Mobile/Email.';
$dataLblArr['LBL_EARNED_AMOUNT']='Earned Amount';
$dataLblArr['LBL_AVERAGE_RATING_TXT']='Average Rating';
$dataLblArr['LBL_NO_THANKS']='No,Thanks';
$dataLblArr['LBL_TIP_TXT']='Would you like to give Tip to driver ?';
$dataLblArr['LBL_REASON_RIDER']='Reason (This will be shown to rider)';
$dataLblArr['LBL_TIP_TITLE_TXT']='TIP';
$dataLblArr['LBL_TIP_AMOUNT_ENTER_TITLE']='Enter Tip amount';
$dataLblArr['LBL_ADD_COUNTRY']='Add Couontry';
$dataLblArr['LBL_ALLOW_ALL_TXT']='Allow All';
$dataLblArr['LBL_MORE_INFO']='more info';
$dataLblArr['LBL_REASON_TO_DRIVE']='Taxiapp';
$dataLblArr['LBL_LOCATIONS_TXT']='Locations';
$dataLblArr['LBL_SELECT_SERVICE_SUB_TXT']='Select Service';
$dataLblArr['LBL_LESS_TXT']='Less';
$dataLblArr['LBL_VIEW_MORE_TXT']='View More';
$dataLblArr['LBL_SELECT_SERVICE_TXT']='Select Service';
$dataLblArr['LBL_SERVICE_MENU_TXT']='Menu';
$dataLblArr['LBL_MAP_TXT']='Map';
$dataLblArr['LBL_LIST_TXT']='List';
$dataLblArr['LBL_JOB_TXT']='Job';
$dataLblArr['LBL_CONTINUE_BTN']='Continue';
$dataLblArr['LBL_QTY_TXT']='QTY';
$dataLblArr['LBL_HOME_MEET_DRIVER']='Meet Our Drivers';
$dataLblArr['LBL_HOME_MEET_DRIVER_CONTENT']='Our driving family welcomes you on board with a smile. Just look out for them!';
$dataLblArr['LBL_SIGNUP_SIGNUP']='SIGN UP';
$dataLblArr['LBL_SIGNUP_777-777-7777']='Phone Number';
$dataLblArr['LBL_SIGNUP_REFERAL_CODE']='Referral Code (Optional)';
$dataLblArr['LBL_SIGNUP_Agree_to']='Agree to';
$dataLblArr['LBL_LOGIN_NEW_DONT_HAVE_ACCOUNT']='Don\'t have an account?';
$dataLblArr['LBL_HOME_DRIVER_COMPANY_TEXT']='Driver Or company? The text to display in homepage after user login.';
$dataLblArr['LBL_CONTECT_US_777-777-7777']='Phone Number';
$dataLblArr['LBL_PROFILE_HEADER_PROFILE_TXT']='Profile';
$dataLblArr['LBL_PROFILE_WE_SEE_YOU_HAVE_REGISTERED_AS_A_DRIVER']='Thanks for registering as an individual driver.';
$dataLblArr['LBL_PROFILE_LANGUAGE_TXT']='Language';
$dataLblArr['LBL_VEHICLE_EDIT_DELETE_RECORD']='\"Edit / Delete Record Feature\" has been disabled on the Demo Admin Panel. This feature will be enabled on the main script we will provide you.';
$dataLblArr['LBL_VEHICLE_CHANGE']='Change';
$dataLblArr['LBL_MAKE_TXT']='Make';
$dataLblArr['LBL_REQUEST_NOW']='Request Now';
$dataLblArr['LBL_REQUEST_LATER']='Request Later';
$dataLblArr['LBL_MYTRIP_TRIPS']='My Trips';
$dataLblArr['LBL_MYTRIP_Search']='Search';
$dataLblArr['LBL_MYTRIP_RESET']='Reset';
$dataLblArr['LBL_MYTRIP_TRIP_TYPE_TXT_ADMIN']='Trip Type';
$dataLblArr['MY_RIDER_REFERAL_CODE']='My Referral Code';
$dataLblArr['LBL_RIDER_PROFILE_YOUR_EMAIL_ID']='YOUR EMAIL ID';
$dataLblArr['LBL_RIDER_YOUR_FIRST_NAME']='YOUR FIRST NAME';
$dataLblArr['LBL_RIDER_YOUR_LAST_NAME']='YOUR LAST NAME';
$dataLblArr['LBL_RIDER_Save']='Save';
$dataLblArr['LBL_RIDER_EDIT']='Edit';
$dataLblArr['LBL_RIDER_CURR_PASS_HEADER']='Current Password';
$dataLblArr['LBL_RIDER_UPDATE_PASSWORD_HEADER_TXT']='NEW PASSWORD';
$dataLblArr['LBL_RIDER_Confirm_New_Password']='Confirm New Password';
$dataLblArr['LBL_RIDER_Phone_Number']='Phone Number';
$dataLblArr['LBL_RIDER_PROFILE_PICTURE']='Profile Picture';
$dataLblArr['LBL_FOOTER_TERMS_AND_CONDITION']='Terms & Condition';
$dataLblArr['LBL_LEFTMENU_SIGN_UP_TO_RIDE']='Sign up to Ride';
$dataLblArr['LBL_LEFTMENU_BECOME_A_DRIVER']='become a driver';
$dataLblArr['LBL_HEADER_HELP_TXT']='Help';
$dataLblArr['LBL_HEADER_MY_EARN']='My Earnings';
$dataLblArr['LBL_HEADER_LOGOUT']='Logout';
$dataLblArr['HOME_HEADER_FIRST_LBL']='Make your day';
$dataLblArr['LBL_WALLET_RIDER_WALLET']='My Wallet';
$dataLblArr['LBL_Wallet_Today']='Today';
$dataLblArr['LBL_Wallet_Yesterday']='Yesterday';
$dataLblArr['LBL_Wallet_Current_Week']='Current Week';
$dataLblArr['LBL_Wallet_Previous_Week']='Previous Week';
$dataLblArr['LBL_Wallet_Current_Month']='Current Month';
$dataLblArr['LBL_Wallet_Previous Month']='Previous Month';
$dataLblArr['LBL_Wallet_Current_Year']='Current Year';
$dataLblArr['LBL_Wallet_Previous_Year']='Previous Year';
$dataLblArr['LBL_Wallet_Search']='Search';
$dataLblArr['LBL_WALLET_ACCOUNT_HOLDER_NAME']='Account Holder Name';
$dataLblArr['LBL_WALLET_NAME_OF_BANK']='Name of Bank';
$dataLblArr['LBL_WALLET_ACCOUNT_NUMBER']='Account Number';
$dataLblArr['LBL_WALLET_BIC_SWIFT_CODE']='BIC/SWIFT Code';
$dataLblArr['LBL_WALLET_BANK_LOCATION']='Bank Location';
$dataLblArr['LBL_WALLET_save']='Save';
$dataLblArr['LBL_WALLET_BTN_PROFILE_CANCEL_TRIP_TXT']='Cancel';
$dataLblArr['LBL_RIDER_Invoice']='Invoice';
$dataLblArr['LBL_RIDER_back_to_listing']='Back to listing';
$dataLblArr['LBL_RIDER_RIDER_INVOICE_Car']='Car';
$dataLblArr['LBL_RIDER_DISTANCE_TXT']='Distance';
$dataLblArr['LBL_RIDER_Trip_time']='Trip time';
$dataLblArr['LBL_RIDER_You_ride_with']='You ride with';
$dataLblArr['LBL_RIDER_Rate_Your_Ride']='Rate Your Ride';
$dataLblArr['LBL_RIDER_FARE_BREAK_DOWN_TXT']='Fare Breakdown';
$dataLblArr['LBL_RIDER_Basic_Fare']='Basic Fare';
$dataLblArr['LBL_RIDER_TIME_TXT']='Time';
$dataLblArr['LBL_RIDER_Total_Fare']='Total Fare';
$dataLblArr['LBL_RIDER_WALLET_DEBIT_MONEY']='Wallet Balance Adjustment';
$dataLblArr['LBL_RIDER_DISCOUNT']='Discount';
$dataLblArr['LBL_RIDER_SURGE_MONEY']='Surge Money';
$dataLblArr['LBL_RIDER_Commision']='Commision';
$dataLblArr['LBL_RIDER_MINIMUM']='Minimum';
$dataLblArr['LBL_Driver_document_BTN_CANCEL_TRIP_TXT']='Cancel';
$dataLblArr['LBL_Driver_document_Save']='Save';
$dataLblArr['LBL_Driver_document_CHANGE']='Change';
$dataLblArr['LBL_Driver_document_UPLOAD_PHOTO']='Upload Photo';
$dataLblArr['LBL_Driver_document_CERTIFICATE_FILE']='Certificate File';
$dataLblArr['LBL_Driver_document_Verification_Certi_Image']='Verification Certi Image';
$dataLblArr['LBL_Driver_document_POLICE_VARIFICATION_CERTIFICATE']='Police Verification Certificate';
$dataLblArr['LBL_Driver_document_CHANGE']='Change';
$dataLblArr['LBL_Driver_document_UPLOAD_NOC']='Upload NOC';
$dataLblArr['LBL_Driver_document_NOC_DOC']='Upload NOC';
$dataLblArr['LBL_Driver_document_NOC_IMAGE']='NOC Image';
$dataLblArr['LBL_Driver_document_NOC']='NOC Document';
$dataLblArr['LBL_Driver_document_BTN_CANCEL_TRIP_TXT']='Cancel';
$dataLblArr['LBL_Driver_document_EXP_DATE_HEADER_TXT']='Exp. Date';
$dataLblArr['LBL_Driver_document_UPLOADE_LICENCE']='Upload Licence';
$dataLblArr['LBL_Driver_document_LICENCE_IMAGE']='Licence Image';
$dataLblArr['LBL_Driver_document_DRIVER_LICENCE']='Driver Licence';
$dataLblArr['LBL_Driver_document_NEED_TO_UPLOAD']='Need to upload';
$dataLblArr['LBL_Driver_document_VERIFICATION_CERTIFICATE']='Varification Certificate';
$dataLblArr['LBL_Driver_document_YOUR_NOC']='Your NOC';
$dataLblArr['LBL_Driver_document_EXP_DATE']='Exp. Date';
$dataLblArr['LBL_Driver_document_LICENCE_NOT_FOUND']='Licence not found';
$dataLblArr['LBL_Driver_document_YOUR_DRIVING_LICENCE']='Your driving licence';
$dataLblArr['LBL_Driver_document-back_to_listing']='Back to listing';
$dataLblArr['LBL_Driver_document_Document_of']='Document of';
$dataLblArr['LBL_Driver_document_SOMETHING_WENT_WRONG']='Something went wrong. Please try again.';
$dataLblArr['LBL_Driver_document_NOT_YOUR_DRIVER_DOCUMENT']='You can not edit another driver Document. Try again.';
$dataLblArr['LBL_COMPANY_DRIVER_PASSWORD']='Password';
$dataLblArr['LBL_QUANTITY_CLOSED_TXT']='Quantity is closed for this service.';
$dataLblArr['LBL_YEAR_TXT']='Year';
$dataLblArr['LBL_MODEL_TXT']='Model';
$dataLblArr['LBL_COLOR_TXT']='Color';
$dataLblArr['LBL_ADD_VEHICLE_TXT']='Add Your Vehicle';
$dataLblArr['LBL_MSG_GIVE_TIP']='Do you want to give tip to driver?';
$dataLblArr['LBL_YES']='YES';
$dataLblArr['LBL_NO']='NO';
$dataLblArr['LBL_REQUIRED_MINIMUM_AMOUT']='Required minimum amount is:';
$dataLblArr['LBL_TRANS_FAILED']='Transaction is failed. Please try again.';
$dataLblArr['LBL_TIP_AMOUNT']='Tip Amount';
$dataLblArr['LBL_ENTER_TIP_AMOUNT']='Enter tip amount';
$dataLblArr['LBL_ADD_DESTINATION_LOCATION_TXT']='Add Destination Location';
$dataLblArr['LBL_GET_FARE_ESTIMATION_TXT']='Get a Fare Estimation';
$dataLblArr['LBL_HOME_PAGE_GET_FIRE_ESTIMATE_TXT']='Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\\'s standard dummy text ever since.';
$dataLblArr['LBL_RIDER_SIGNUP1_TXT']='Sign up to Ride';
$dataLblArr['LBL_CHOOSE_VEHICLE']='Choose Vehicles';
$dataLblArr['LBL_ADD_VEHICLE']='Add Vehicle';
$dataLblArr['LBL_SERVICE_DESCRIPTION']='Service Description';
$dataLblArr['LBL_AWAY']='away';
$dataLblArr['LBL_ADD_VEHICLE']='Add Vehicle';
$dataLblArr['LBL_AWAY']='away';
$dataLblArr['LBL_REGISTRATION_DOC']='Registration Doc';
$dataLblArr['LBL_CONFIRM_DELETE_DOC']='Are you sure?you want to delete document?';
$dataLblArr['LBL_SERVICE_TXT']='Service';
$dataLblArr['LBL_UPLOAD_SERVICE_AFTER_TXT']='Click and upload photo of your car after your service';
$dataLblArr['LBL_UPLOAD_SERVICE_BEFORE_TXT']='Click and upload photo of your car before your service';
$dataLblArr['LBL_AFTER_SERVICE']='After Service';
$dataLblArr['LBL_BEFORE_SERVICE']='Before Service';
$dataLblArr['LBL_SEND_REQUEST']='Send Request';
$dataLblArr['LBL_UPLOAD_IMAGE_SERVICE']='Upload Photo';
$dataLblArr['LBL_SAVE_PHOTO_START_SERVICE_TXT']='Save Photo and Start Service';
$dataLblArr['LBL_SAVE_PHOTO_END_SERVICE_TXT']='Save Photo and End Service';
$dataLblArr['LBL_DRIVER_DETAIL']='Washer Detail';
$dataLblArr['LBL_CONFORM_PASSWORD_TXT']='Confirm Password';
$dataLblArr['LBL_NEW_PASSWORD_TXT']='New Password';
$dataLblArr['LBL_SUBMIT_BUTTON_TXT']='Submit';
$dataLblArr['LBL_RESET_PASSWORD_TXT']='RESET PASSWORD';
$dataLblArr['LBL_EMAIL_TEXT']='Email';
$dataLblArr['LBL_PASSWORD_TXT']='Password';
$dataLblArr['LBL_PRIVACY_POLICY_TEXT']='Privacy Policy';
$dataLblArr['LBL_EMAIL_TEXT_SIGNUP']='Email Id';
$dataLblArr['LBL_PASSWORD_SIGNUP']='Password';
$dataLblArr['LBL_SIGNUP_PHONE_VERI']='Phone Verification';
$dataLblArr['LBL_COMPANY_SIGNUP']='Company Name';
$dataLblArr['LBL_ADDRESS_SIGNUP']='Address';
$dataLblArr['LBL_ADDRESS2_SIGNUP']='Address2';
$dataLblArr['LBL_CITY_SIGNUP']='City';
$dataLblArr['LBL_TRIP_PAYMENT_RECEIVED']='Payment received for trip number:';
$dataLblArr['LBL_ZIP_CODE_SIGNUP']='Zip Code';
$dataLblArr['LBL_SELECT_CURRENCY_SIGNUP']='Select Currency';
$dataLblArr['LBL_DATE_SIGNUP']='Date';
$dataLblArr['LBL_MONTH_SIGNUP']='Month';
$dataLblArr['LBL_YEAR_SIGNUP']='Year';
$dataLblArr['LBL_CAPTCHA_SIGNUP']='Captcha';
$dataLblArr['LBL_CAPTCHA_CANT_READ_SIGNUP']='Can\'t read the image?';
$dataLblArr['LBL_CLICKHERE_SIGNUP']='Click here.';
$dataLblArr['LBL_SIGNUP_INDIVIDUAL_DRIVER']='Individual Driver';
$dataLblArr['LBL_SIGNUP_PHONE_VERI_TEXT']='To complete the driver registration process, you must have to enter the verification code sent to your registered phone number.';
$dataLblArr['LBL_SIGNUP_ENTER_CODE']='Enter Verification code below';
$dataLblArr['LBL_SIGNUP_VERIFY']='Verify';
$dataLblArr['LBL_SIGNIN_DRIVERSIGNIN']='Driver Sign In';
$dataLblArr['LBL_SIGNIN_RIDER']='Rider';
$dataLblArr['LBL_SIGNIN_RIDER_SIGNIN']='Rider sign in';
$dataLblArr['LBL_SIGNIN_DRIVER']='Driver';
$dataLblArr['LBL_DRIVERLOGIN_SIGNIN']='SIGN IN';
$dataLblArr['LBL_DRIVERLOGIN_SINCE_IT_IS_DEMO']='Since it is demo, Your account will expire after 7 days from registration';
$dataLblArr['LBL_LOGIN_FORGET_PASS']='Forgot password?';
$dataLblArr['LBL_LOGIN_RECOVER_PASSWORD']='Recover Password';
$dataLblArr['LBL_DRIVERLOGIN_LOGIN']='Login';
$dataLblArr['LBL_HOME_RIDING_TEXT']='The text to display in homepage after user login.';
$dataLblArr['LBL_HOME_ADD_PICKUP_LOC']='Add PickUp Location';
$dataLblArr['LBL_KINDLY_PROVIDE_BELOW_VISIBLE_DRIVER']='Kindly provide below documents to validate your account as a driver.';
$dataLblArr['LBL_PROFILE_BIRTHDAY_TXT']='Birthday';
$dataLblArr['LBL_PROFILE_SELECT_COUNTRY']='Select Country';
$dataLblArr['LBL_PROFILE_SELECT_TEXT']='--select--';
$dataLblArr['LBL_PROFILE_SELECT_CURRENCY']='Select Currency';
$dataLblArr['LBL_PROFILE_DESCRIPTION_TEXT']='Profile Description';
$dataLblArr['LBL_PROFILE_SELECT_LANGUAGE']='Select Language';
$dataLblArr['LBL_PROFILE_BANK_HOLDER_TXT']='Bank Account Holder Name';
$dataLblArr['LBL_PROFILE_UPLOAD_LICENCE']='Upload Licence';
$dataLblArr['LBL_PROFILE_CERTI_NOT_FOUND']='Certificate not found';
$dataLblArr['LBL_PROFILE_NOC_NOT_FOUND']='NOC not found';
$dataLblArr['LBL_PROFILE_LICENCE_NOT_FOUND']='Licence not found';
$dataLblArr['LBL_VEHICLE_REGISTRATION_DOC']='Registration Doc';
$dataLblArr['LBL_VEHICLE_CONFIRM_DELETE_DOC']='Are you sure?you want to delete document?';
$dataLblArr['LBL_VEHICLE_REGI_IMAGE']='Registration Image';
$dataLblArr['LBL_VEHICLE_PERMIT_IMAGE']='Permit Image';
$dataLblArr['LBL_HEADER_WELCOME']='Welcome!';
$dataLblArr['LBL_HEADER_MY_AVAILABILITY']='My Availability';
$dataLblArr['LBL_HEADER_TOPBAR_TRIPS_TEXT']='My Trips';
$dataLblArr['LBL_MYTRIP_RESET_TXT']='Reset';
$dataLblArr['LBL_MYTRIP_TRIP_TYPE']='Trip Type';
$dataLblArr['LBL_MYTRIP_RIDE_NO_TXT']='Ride No';
$dataLblArr['LBL_MYTRIP_TRIP_RIDER']='Rider';
$dataLblArr['LBL_MYTRIP_TRIPDATE']='Trip Date';
$dataLblArr['LBL_MYTRIP_CAR_TYPE']='Car Type';
$dataLblArr['LBL_MYTRIP_VIEW']='View';
$dataLblArr['LBL_MYTRIP_CANCELED_TXT']='Canceled';
$dataLblArr['LBL_MYEARNING_RECENT_RIDE']='Recent Rides';
$dataLblArr['LBL_MYEARNING_PAYMENT_TXT']='Payment';
$dataLblArr['LBL_MYEARNING_PAID_TRIPS']='Paid Trips';
$dataLblArr['LBL_HOUR']='Hour';
$dataLblArr['LBL_MYEARNING_ID']='ID';
$dataLblArr['LBL_MYEARNING_INVOICE']='Invoice';
$dataLblArr['LBL_MYEARNING_REQUEST_PAYMENT']='Request Payment For';
$dataLblArr['LBL_WALLET_TRIP_NO']='Trip No';
$dataLblArr['LBL_WALLET_TOTAL_BALANCE']='Total Balance';
$dataLblArr['LBL_VIA_CASH_TXT']='Via Cash';
$dataLblArr['LBL_VIA_CARD_TXT']='Via Card';
$dataLblArr['LBL_RESET_PAGE_BACK_LINK_TXT']='Not You ?';
$dataLblArr['LBL_SORRY_TIME_EXPIRED_TXT']='Sorry !Time expired';
foreach($dataLblArr as $key => $value)
{
	
	$sql = "SELECT * FROM `language_label` WHERE  vLabel='".$key."'";
	$data = $obj->MySQLSelect($sql);
	
	if(count($data) < 1){
		$sql_other = "SELECT * FROM `language_label_other` WHERE  vLabel='".$key."'";
		$data_other = $obj->MySQLSelect($sql_other);
		
		if(count($data_other) < 1){
			$sql_code = "SELECT * FROM `language_master`";
			$data_code = $obj->MySQLSelect($sql_code);
			echo $key."<BR/>";
			
			for($i=0;$i<count($data_code);$i++){
				$vCode = $data_code[$i]['vCode'];
				
				$LangData['vCode'] = $vCode;
				$LangData['vLabel']=$key;
				$LangData['vValue']=$value;
				$LangData['lPage_id']="0";
				// echo "<pre>";print_r($LangData);exit;
				$obj->MySQLQueryPerform("language_label",$LangData,'insert');
			}
		}
	}
}
?>