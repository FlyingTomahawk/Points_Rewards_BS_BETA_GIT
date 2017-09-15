# Points_Rewards_BS_BETA_GIT

To do list and tasks asigend:

 Steps proposal:

- fixes for undefined errors (already partly done, working on this 10/09/2017 @raiwa)

- fixes for known bugs like the one posted by @LeeFoster (asigned to @Tsimi 11/09/2017)

- create header tag module: (will begin with this 11/09/2017 @raiwa)

    - add installation scripts for database DONE 11/09/2017 @raiwa
    - add configuration entries DONE 11/09/2017 @raiwa
    - change all configuration constants to ht constants DONE 11/09/2017 @raiwa
    - Replace all "true/false" to core spelling "True/False" DONE 11/09/2017 @raiwa
    - add code for the pages where it is possible and remove from core files
      - logoff.php DONE 11/09/2017 @raiwa
      - product_reviews_write.php first part DONE 11/09/2017 @raiwa
      - checkout_confirmation.php DONE 12/09/2017 @raiwa
      - checkout_payment.php javascript 13/09/2017 @raiwa
    - add language definitions to header tag language file where possible

- create hook:

    add functions for the pages where it makes sense and remove code changes from core files
    add language definitions to hook language file and remove from core language files
    
    - create_account.php DONE 13/09/2017 @raiwa

- create modified content modules to replace core modules DONE 15/09/2017
  - info box asigned DONE 15/09/2017 @Tsimi
  - info footer module DONE @LeeFoster 12/09/2017
  - shopping cart box asigned DONE 12/09/2017 @Tsimi 
  - shopping cart navbar module asigned DONE 13/09/2017 @Tsimi
  
- create product info content module
  - point module for Modular product info by kymation DONE 12/09/2017 @LeeFoster
  - point module for core product info DONE 12/09/2017 @raiwa
  
- clean up my_points_help.php language file asigend DONE 14/09/2017 @raiwa

- alternative fix for bug 2 asigned DONE (needs hardcore check) @raiwa 15/09/2017
  - create payment module "points"
  - modify info box on checkout payment for payment module selection
  - move session register 'customer_shopping_points_spending' in checkout_confirmation.php into hook.
  - remove all related and obsolete changes in checkout_payment.php, checkout_confirmation_php and payment class

- revise all html tags for BS integration

- revise and fix "known bugs" asigend to @LeeFoster and @Tsimi
  - 1 fixed 12/09/20017 @LeeFoster and @Tsimi
  - 2 fixed 13/09/20017 @LeeFoster
  - 3 fixed 12/09/20017 @LeeFoster and @Tsimi
  - 4 fixed 14/09/20017 @LeeFoster
  - 5 fixed 13/09/20017 @raiwa
  - 6 fixed 14/09/20017 @LeeFoster 

- add installation script to header tag module (hooks register and calls) 

- write new installation user guide. (PDF/WORD) native english speaker?
