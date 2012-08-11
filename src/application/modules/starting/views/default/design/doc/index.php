<h1>Introduction</h1>
<br>
<p>The Layout Module is a module for the <a href="https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/wiki/Home">Modular Extensions - HMVC</a> library for the <strong>CodeIgniter</strong> framework. Layout Module is <strong>inspired on the Magento layout system</strong>. The goal is to provide a simple, orderly and practial way to handle the layout in projects.</p>
<p>The library provides the typical php methods like a simple layout library, but additional, and here is the goal, Layout Module provides an abstraction layer where you will define the layout structure and logic through xml files.</p>
<p>Aclaration before you continue reading.... There is some documentation, but isn't complete. Please read it all, and if you keep doubts you should start playing with the code. It's really easy and simple, belive me. The best examples are in the code. Just <a href="https://github.com/emateu/codeigniter-layout-module-hmvc/zipball/master">download</a> and try it. All this documentation is included in the 'starting' module, you can check that module for learn.</p>
<p>Here is an example of xml file that defines a page layout:</p>
<pre class="prettyprint linenums">
&lt;layout&gt;
    &lt;default template="layout/page/1column"&gt;
        &lt;head&gt;
            &lt;title&gt;HMVC Layout Module&lt;/title&gt;
            &lt;css&gt;layout/css/bootstrap.min.css&lt;/css&gt;
            &lt;css&gt;layout/css/bootstrap-responsive.min.css&lt;/css&gt;
            &lt;css&gt;layout/css/styles.css&lt;/css&gt;
            &lt;js&gt;layout/js/lib/jquery.min.js&lt;/js&gt;
            &lt;js&gt;layout/js/lib/bootstrap.min.js&lt;/js&gt;
        &lt;/head&gt;
        &lt;body class="home"&gt;
            &lt;col-main&gt;
                &lt;block template="home/welcome" /&gt;
            &lt;/col-main&gt;
            &lt;col-left&gt;
                &lt;block template="page/sidebar" /&gt;
            &lt;/col-left&gt;
        &lt;/body&gt;
    &lt;/default&gt;
&lt;/layout&gt;
</pre>

<p>For each controller of the module, we will have a xml file that will define the layout for all actions of that controller. Then, for each action, we can define some rules that will override or extend the default controller definitions. For example:</p>
<pre class="prettyprint linenums">
&lt;layout&gt;
    &lt;default template="layout/page/1column"&gt;
        &lt;head&gt;
            &lt;css&gt;module/styles.css&lt;/css&gt;
        &lt;/head&gt;
    &lt;/default&gt;
    
    &lt;faq template="layout/page/2columns-left"&gt;
        &lt;head&gt;
            &lt;title&gt;Frecuently Asked Questions&lt;/title&gt;
        &lt;/head&gt;
        &lt;body&gt;
            &lt;col-main&gt;
                &lt;block template="module/faq" /&gt;
            &lt;/col-main&gt;
        &lt;/body&gt;
    &lt;/faq&gt;
    
    &lt;contact_us&gt;
        &lt;head&gt;
            &lt;title&gt;Contact Us&lt;/title&gt;
            &lt;js&gt;module/form-validation.js&lt;/js&gt;
        &lt;/head&gt;
        &lt;body class="contact-us-page"&gt;
            &lt;col-main&gt;
                &lt;block template="module/contact_us" /&gt;
            &lt;/col-main&gt;
        &lt;/body&gt;
    &lt;/contact_us&gt;
&lt;/layout&gt;
</pre>

<p>As explained before, imagine we have a controller that has two actions: <code>faq ()</code> and <code>contact_us ()</code>. So the <code>&lt;default&gt;&lt;/default&gt;</code> section defines rules that will applied for all actions of that controller, for example the layout template that will be used <code>layout/page/1column</code> and the css file that will be included <code>module/styles.css</code>.</p>
<p>After that, as you can see, for the <code>faq ()</code> action we overrided the page layout, setting <code>layout/page/2columns-left</code> as the template file to use, we defined the page <code>&lt;title&gt;&lt;/title&gt;</code> and included a partial view <code>module/faq</code> in the col-main reference of the layout template.</p>
<p>Finally, for the <code>contact_us ()</code> action we defined the <code>&lt;title&gt;&lt;/title&gt;</code> again, we included a javascript file <code>module/form-validation.js</code> that will only be called in this action, added the class <code>contact-us-page</code> to the <code>&lt;body&gt;</code> and included a partial view <code>module/contact_us</code> to the col-main reference of the layout template.</p>