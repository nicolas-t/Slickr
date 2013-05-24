##Slickr
-----------
Slickr is an easy to template module that display your flickr photos on your own server.

#### Dependencies
 PHP 5  
 jQuery. https://github.com/jquery/jquery  
 Chocolat. https://github.com/nicolas-t/chocolat


#### Compatibility
recent browsers such as :  
 IE 7+, Safari, Firefox & Chrome.

 
#### Demo & Website
 http://slickr.net/demo  
 http://slickr.net

 
#### Notes
**cache**  
Slickr makes heavy use of cache (images & markup).   
You'll have to disable it from the admin panel (by setting lifespan to 0) or empty cache the folder after each modifications.  


##Installation
 CHMOD 777 the following folders/files:  
 `/cache/`  
 `/admin/install.php`  
 `config.template.php`  
 `disabled.htaccess`  

run :  
 `admin/install.php`  
 
once installed find admin panel here :  
  `yoursite.com/admin/`  

##Documentation

######Structures :
-----------

 Structure of the site depends on the homepage chose from the admin.  

**Latest Upload:**
<pre>
 Images  
</pre>

**Photosets:**
<pre>
 Photosets  
 |--Images  
</pre>

**Collections:**
<pre>
 Collections  
 |--Collecphotosets  
    |--Images  
</pre>

###### Templates 
-----------

 default template is `positif`.

**collecphotosets.php:**  
 Template for the photosets inside collections

**collections.php:**  
 Template for the collections.

**photosets.php:**  
 Template for the photosets.

**images.php:**  
 Template for the images.

**footer.php:**  
 Template for the footer of every pages.
 
###### MVC
-----------

 Slickr use a MVC structure.

 * `index.php` is the controller.
 
 * `slickr.class.php` is the model.
 
 * `your-template/your-page.php` is your view.
 
## Methods
	
 **$core->createUrl($image,$size) :** `params : image, size`  
 Param :  
 * image `array` : the image (as an array returned from the method `$slickr->getPhotos()` you want to link to.  
 * size `string` : the size of the image:
	 <dl>
	  <dd>`_s` : 75px*75px sqsuare</dd>
	  <dd>`_t` : 100px on the largest side</dd>
	  <dd>`_m` : 240px on the largest side</dd>
	  <dd>`_z` : 640px on the largest side</dd>
	  <dd>`_b` : 1 024px on the largest side</dd>
	  <dd>`_biggest` : look for an original size if available, else takes the biggest size available</dd>
	</dl>
 Returns :    
 the url of the image  

-----------

**$slickr->getPhotos() :** `param : none`  
 Returns :  
 * images : the photos of the current photoset
 * parent : informations about the parent photoset (title & description)

**$slickr->getLatestPhotos() :** `param : none`  
 Returns :  
 * images : the latest photos you uploaded on flickr
 * parent : "Latest Images"

**$slickr->getPhotosets() :** `param : none`  
 Returns :  
 * collecSets : the different sets in the current collection
 * sets : the different sets (when the homepage is set to "Photosets"
 * parent : information about the parent collection (title)

**$slickr->getCollections() :** `param : none`  
 Returns :  
 * collections : the different collections (in the current collection)
 * parent : informations about the parent (if exists) collection (title & description)

-----------

**$cache->saveCache($content) :** `param : content`  
 Save to cache the html content passed as parameter    
 return : true|false 

**$cache->getCache() :** `param : none`  
 Show the cached content if available   
 Else start generating new cache for the page.
