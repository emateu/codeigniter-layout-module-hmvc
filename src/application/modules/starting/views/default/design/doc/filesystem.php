<h1>The filesystem</h1>
<br>
<p>The filesystem of the Layout Module follow the line of <a href="https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/wiki/Home">Modular Extensions - HMVC</a> pattern (because we use it, it's depency) but in the <code>views</code> directory we create our custom structure, let's see:</p>
<pre class="prettyprint linenums">
+ application
--+ modules
----+ module_name
------| controllers
------+ views
--------+ <strong>skin_name</strong>
----------| <strong>design</strong>
----------| <strong>layout</strong>
----------| <strong>skin</strong>
------| ...
------| ...
</pre>

<h2>Explanation</h2>
<ul>
    <li>
        <code>design</code> contains partial views: any.php template file. Here you can define the structure you like. For example:
<pre class="prettyprint linenums">
+ application
--+ modules
----+ module_name
------| controllers
------+ views
--------+ <strong>skin_name</strong>
----------+ design
------------| <strong>header.php</strong>
------------| <strong>footer.php</strong>
------------| <strong>home.php</strong>
----------| layout
----------| skin
------| ...
------| ...
</pre>
    <p>So then you can call and print a partial view with the block() method: <code>echo $this->layout->block('module_name/header')</code>.</p>
    </li>
    <li>
        <code>layout</code> contains .xml files that defines the layout.
<pre class="prettyprint linenums">
+ application
--+ modules
----+ module_name
------| controllers
------+ views
--------+ <strong>skin_name</strong>
----------| design
----------+ layout
------------| <strong>default.xml</strong>
------------| <strong>controller_name.xml</strong>
------------| <strong>another_controller_name.xml</strong>
----------| skin
------| ...
------| ...
</pre>
        <p>Here you allways will have a <code>default.xml</code> file, where you should define the general layout config for your module (if you have a default config) and a <code>controller_name.xml</code> file for each controller in your module that use the layout module. Please <a href="<?php echo site_url('starting/doc/load_method_xml_files') ?>">check more about the xml layout files</a>.</p>
    </li>
    <li>
        <code>skin</code> contains css, js, and img resources. I like the following structure but it's up to you.
<pre class="prettyprint linenums">
+ application
--+ modules
----+ module_name
------| controllers
------+ views
--------+ <strong>skin_name</strong>
----------| design
----------| layout
----------+ <strong>skin</strong>
------------| <strong>css</strong>
------------| <strong>img</strong>
------------| <strong>js</strong>
------------| <strong>.htaccess</strong> »»» this file is needed so we dont get 403 error!
------| ...
------| ...
</pre>
    </li>
</ul>