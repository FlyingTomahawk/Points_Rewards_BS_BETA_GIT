####### POINTS AND REWARDS MODULE V3.0 for osc2.3.4 #########
  created by Ben Zukrel, Deep Silver Accessories
  http://www.deep-silver.com

  Modified by Yan, SY FUNG (yanotcook@aliyun.com)

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
  
###############  README  ########################

Writen by DEEP SILVER ACCESSORY Contributed to the osCommerce Project under the GNU General Public License.

This V3.0 is to be used with osCommerce-2.3.4 (NOT BACKWARD COMPATIBLE TO PREVIOUS RELEASES)!!!

Dated:  2014/Dec/23 V3.0 for osc2.3.4

What does this module do ?
------------------------------------
I think that the title say it all.
This is a Points and Reawrds system,(more or like a cash back or discount system)
aimed to popup sales and get new usrs to signup.
The system awards shopping points to customers for the amount they spend.
Points consider as cash when redeemed, so points are in pending status untill approved by admin.(manually)
Once approved, customers can then use those points to pay for order druing checkout.

Admin features.
------------------------------------

* Enable/Disable the Points System. 
* Enable/Disable the Redemptions System.(maybe you would like to offer a gift and not money back). 
* Set the number of points awarded for evry $1.00 spent(or whatever based on your currency system). 
* Set the value of each point(based on your currency system). 
* Pad the points value amount of decimal places. 
* Enable Auto Credit Pending Points and set a days period before the reward points will actually added to customers account. 
* Enable Auto Expires Points and Set a month period before points will auto Expires. 
* Enable Points Expires Auto Remainder and set the numbers of days prior points expiration for the script to run. 
* Enable/Disable points awarded for shipping fees. 
* Enable/Disable points awarded for taxes. 
* Enable/Disable points awarded for discounded products. 
* Enable/Disable points awarded for order with redeemed points. 
* Enable/Disable points awarded for Reviews. 
* Enable/Disable points awarded for Referral. 
* Enable/Disable Products Restriction. 
* Set the model name allowed When Products Restriction enabled.(only one group) 
* Set the Products Id allowed When Products Restriction enabled.(unlimited products) 
* Set the Categories ID allowed When Products Restriction enabled.(unlimited categories path) 
* Enable/Disable Products Price Restriction. 
* Enable/Disable Points Limitation. and set the number. of points needed before they can be redeemed. 
* Set the maximum Points allowed to be redeemed per order. 
* Limit Points Redemptions to exact amount. 
* Restrict Points Redemption For Minimum Purchase Amount. 
* Enable/Disable Points credit information. shown in products info page. 
* Enable/Disable Welcome Points. and set the Points amount to be auto-credited for New signup customers. 
* Admin can view/add/delete customers points with/without queuing customers points table(optimised the database) and with/without notifiying customers. 
* Admin can view/add/delete/cancel/adjust/roll back customers pending points with/without queuing customers points table(optimised the database) and with/without notifiying customers. 
* Set the numbers of records to show per page at my_points.php page. 
* Enable/Disable Keeping Records of Redeemed Points.

Customes features.
------------------------------------
* New signup customers can be awarded with welcome points.
* Customers can earn points(cash back) for an item purchased at the store.
* Customers can earn points for writing Reviews.
* Customers can earn Referral points.
* Customers can view their shoping points account status.
* Customers can pay for their order partly with points and partly with other payment method.

The system designed to use minimum database space, customers points hold in customers table while
all other points hold in customers_points_pending table.
Once pending points approved by admin, pending points move to customers account so table used stay optimised.
Redeemed points recorded in customers order history only.(unless set in admin).

What this module does not do ?
------------------------------------
1.The system designed for a small to medium shops.
Since shopping points cosider as money when redeemed. awarded points default status is pending.
Customers shopping points account will never be auto-credited(except points for new signup if enabled).
if you own a large shop with lots of orders daily, it could be hard to keep track of points
then this system is NOT for you.
2.When admin delete order while points status for that order is still pending. those points will also be
deleted, however if admin already approved those points, admin must delete them manually(via admin panel).

This module as been tested on a fresh install of osCommerce Version 2.2MS2
as well as on a fully modified versions (includes Credit Class & Gift Voucher contribution).
Please use it at your own risk.

This zip package includes...
* A folder contain all files and images required by this module .
* A folder contain all images, new and modified files required by this module (for a fresh install).
* Step by step installation instrctions(currently n english only).
All support handled through the osCommerce forums. Please do not email directly.
http://forums.oscommerce.com/index.php?showtopic=152746

As a respect to the contributors and as part of GNU General Public License
You are not allowed to remove any of the comments/links to oscommerce web site.

------------------------------------------------------------------------------------------

Sol Harris Introduction continued....

Having said all of that, I'm glad I stuck with this installation .
This contribution is probably one of the best -- but good luck getting it running, you'll need it!

Assuming you have a decent website that is selling decent products that people actually want, 
this contribution can be a very powerful method of capturing your visitors attention!
They can earn points by referring their friends to your site (when their friend buys something) and thereby,
you can increase the number of your customers.
They can also earn points for buying products and for writing reviews, so now they are even more motivated.
However, you should be careful how generous you are since you could easily end up giving away a lot of points / products.

Getting it working is very satisfying! However, be warned -- there are some tough steps ahead and you may need to
search the forums once you have got this installed -- for additional advice.
The forum for this mod is a challenge in itself -- there are over 82 pages and counting !!! 
Try finding your answer in that lot! The OSC forum search tool really could be improved!
I found this to be particularly the case with Paypal IPN which caused all sorts of issues for me. 
It took me a few days to find all the updates in the forums -- for some reason, 
many of these updates or additional fixes have not been posted to the contribution page. 
I can only assume that is because they are not required on the standard package!
Because of this, I have chosen not to include these updates in this file package because, clearly, 
the "standard" package appears to work for most people -- perhaps I just have a very quirky / heavily modified site!
The point I'm making is: once you're done installing -- if you have issues, 
there is probably a fix for it in the forum -- although finding the fix is a job in itself !


WORD OF CAUTION

If your live site is busily making you money -- you don't want to mess with a good thing until you're certain! 
I would suggest that you consider installing this on a test site before hand.
Also I have not tested this contribution on a download site, so if that's you, you're on your own I'm afraid.

Regards
Sol Harris August 2008
(username SSNB)
(www.boomskateboarding.com)
