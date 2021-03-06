Quickstart
==========

This page describes how to get started using the Trovebox API quickly.


Installation
------------

Install Trovebox-PHP using `Composer <http://getcomposer.org/>`_

.. code::

     shell$ composer install mrzen/trovebox-php
     
Or add it to your ``composer.json`` file.



Connecting
----------

To connect to the API you need to provide it with the following data:

* API Endpoint (this will vary depending on your account)
* Conumser Key
* Consumer Secret
* Token
* Token Secret


The keys and secrets can be set up using "Apps" in trovebox.

You can create a client using any of the following options:

* JSON String
* Path to JSON file
* Associative Array
* Setting the ``$_SERVER['CONFIG']`` to a json string or path to file

The JSON file should look like this:

.. code:: javascript

   {
          "base_url" : "http://your-account.trovebox.com/",
          "oatuh" : {
          "consumer_key"    : "YOUR_CONSUMER_KEY",
          "consumer_secret" : "YOUR_CONSUMER_SECRET",
          "token"           : "YOUR_TOKEN",
          "token_secret"    : "YOUR_TOKEN_SECRET"
          },

          "defaults" : { "auth" : "oauth" }
   }


.. warning::
   The ``defaults`` section is required for authenticated API operations
   


Example
^^^^^^^


.. code:: php

          $trovebox = new Trovebox\Client($YOUR_CONFIG);

          $trovebox->hello();


The ``Trovebox\Client::hello`` method will run the Trovebox "Hello" API call to make sure you're connected.



Getting Photos
%%%%%%%%%%%%%%

Now that we've connected to the Trovebox API, let's get some data.


.. code:: php

          // $trovebox is the trovebox client we created in the previous example
          
          $photos = $trovebox->photos(); // Will get the 30 most recent photos

          // $photos is an array of \Trovebox\Models\Photo
   
          foreach($photos as $photo) {
              echo $photo . "\n"; // Print out the photo
          }


For more information, see :doc:`Working with photos </photos>`
