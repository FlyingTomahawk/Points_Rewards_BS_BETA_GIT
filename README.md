# Points_Rewards_BS_BETA_GIT

To do list and tasks asigend:

 Steps proposal:

- fixes for undefined errors (already partly done, working on this 10/09/2017 @raiwa)

<s>- fixes for known bugs like the one posted by @LeeFoster (asigned to @Tsimi 11/09/2017) DONE

- create header tag module: (will begin with this 11/09/2017 @raiwa) DONE

    - add installation scripts for database DONE 11/09/2017 @raiwa
    - add configuration entries DONE 11/09/2017 @raiwa
    - change all configuration constants to ht constants DONE 11/09/2017 @raiwa
    - Replace all "true/false" to core spelling "True/False" DONE 11/09/2017 @raiwa
    - add code for the pages where it is possible and remove from core files
      - logoff.php DONE 11/09/2017 @raiwa
      - product_reviews_write.php first part DONE 11/09/2017 @raiwa
      - checkout_confirmation.php DONE 12/09/2017 @raiwa
      - checkout_payment.php DONE javascript 13/09/2017 @raiwa</s>
    - add language definitions to header tag/hook language file where possible

- create hook:

    <s>add functions for the pages where it makes sense and remove code changes from core files
    add language definitions to hook language file and remove from core language files
    
    - create_account.php DONE 13/09/2017 @raiwa
    - checkout_payment.php DONE 16/09/2017 @raiwa
    - checkout_confirmation.php DONE 16/09/2017 @raiwa
    - checkout_process.php DONE 16/09/2017 @raiwa
    - admin/orders.php DONE 16/09/2017 @raiwa</s>

- create modified content modules to replace core modules DONE 15/09/2017

  <s>- info box asigned DONE 15/09/2017 @Tsimi
  - info footer module DONE @LeeFoster 12/09/2017
  - shopping cart box asigned DONE 12/09/2017 @Tsimi 
  - shopping cart navbar module asigned DONE 13/09/2017 @Tsimi
  
- create product info content module
  - point module for Modular product info by kymation DONE 12/09/2017 @LeeFoster
  - point module for core product info DONE 12/09/2017 @raiwa
  
- create reviews content module DONE 17/09/2017 @raiwa
  - include it in product_reviews.php, product_reviews_write.php and reviews.php DONE 18/09/2017

- clean up my_points_help.php language file asigend DONE 14/09/2017 @raiwa
  - remove "last modfied" DONE 16/09/2017 @raiwa
  - fix restricted products and categories listing DONE 16/09/2017 @raiwa</s>

- alternative fix for bug 2 asigned DONE (needs hardcore check) @raiwa 15/09/2017
  <s>- create payment module "points"
  - modify info box on checkout payment for payment module selection
  - move session register 'customer_shopping_points_spending' in checkout_confirmation.php into hook.
  - remove all related and obsolete changes in checkout_payment.php, checkout_confirmation_php and payment class</s>

- revise all html tags for BS integration

- revise and fix "known bugs" asigend to @LeeFoster and @Tsimi
  <s>- 1 fixed 12/09/2017 @LeeFoster and @Tsimi
  - 2 fixed 13/09/2017 @LeeFoster
  - 3 fixed 12/09/2017 @LeeFoster and @Tsimi
  - 4 fixed 14/09/2017 @LeeFoster
  - 5 fixed 13/09/2017 @raiwa
  - 6 fixed 14/09/2017 @LeeFoster
  - 7 fixed 15/09/2017 @raiwa
  - 8 fixed 15/09/2017 @raiwa
  - 9 fixed 15/09/2017 @raiwa
  - 10 fixed 19/09/2017 @raiwa</s>
  
- revise other languages
  - english @LeeFoster ?
  - german asigned @Tsimi 17/09/2017
  - spanish asigned @raiwa 17/09/2017
  
- add other language translations
  - english @LeeFoster ?
  - german asigned @Tsimi 17/09/2017
  - spanish asigned @raiwa 17/09/2017
  
- add version, developer and copyright info to header comments in all files. @Tsimi/@LeeFoster?

- add installation script to header tag module (hooks register and calls) asigned @raiwa

- write new installation user guide. (PDF/WORD) native english speaker? @Tsimi/@LeeFoster?
