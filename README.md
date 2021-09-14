
[![Issues](https://img.shields.io/github/issues/abhishek-openeyes/caches?style=flat-square)](https://github.com/guzzle/)
[![License](https://img.shields.io/github/license/abhishek-openeyes/caches?style=flat-square)](https://packagist.org/packages/)

1> create constant file in config folder
    -> now add 
    <?php

    return [
         'CACHE' => [
            'cache_name' => ["tbl_name"=>"tbl_name","file_name"=>"cache_file_name"],
         ]
    ]

2> Use in controller 
   use theopeneyes\caches\CachePackage;
      
      -> For Set Cache 
      CachePackage::set('Constant_name',500);
      
      -> For get Cache      
      CachePackage::get('Constant_name');
      
      -> Search With key & value
      CachePackage::getWithSearch('Constant_name','key_name','value_name');
      
      ->Delete Cache 
      CachePackage::delete('Constant_name');
      
      ->Delete All Cache
      CachePackage::deleteAll();    