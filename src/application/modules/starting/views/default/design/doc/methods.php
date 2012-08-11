<h1>Methods</h1>
<br>

<h2>skin (<code>string</code>)</h2>
<p>Defines the skin to work with.</code></p>
<pre class="prettyprint linenums">
$this->layout->skin('skin_name');
</pre>
<p>If not skin is defined, <code>default</code> skin will be used.</p>

<h2>css (<code>module_name/path_to_file | array</code> [, <code>bool = false</code>])</h2>
<p>Adds a css file to queue that will be loaded inside <code>&lt;head&gt;&lt;/head&gt;</code>.</p>
<pre class="prettyprint linenums">
$this->layout->css('styles.css');
</pre>
<p>This method starts searching in <code>application/modules/<strong>module_name</strong>/views/skin_name/skin/</code> of the <a href="<?php echo site_url('starting/doc/filesystem') ?>">filesystem</a>.</p>
<p>If second argument is <code>true</code>, file will be removed from the queue.</p>

<h2>js (<code>module_name/path_to_file | array</code> [, <code>bool = false</code>])</h2>
<p>Adds a javascript file to queue that will be loaded inside <code>&lt;head&gt;&lt;/head&gt;</code>.</p>
<pre class="prettyprint linenums">
$this->layout->js('styles.css');
</pre>
<p>This method starts searching in <code>application/modules/<strong>module_name</strong>/views/skin_name/skin/</code> of the <a href="<?php echo site_url('starting/doc/filesystem') ?>">filesystem</a>.</p>
<p>If second argument is <code>true</code>, file will be removed from the queue.</p>

<h2>title (<code>string</code>)</h2>
<p>Defines the page title: <code>&lt;title&gt;<strong>Argument</strong>&lt;/title&gt;</code>.</p>
<pre class="prettyprint linenums">
$this->layout->title('Argument');
</pre>

<h2>body_class (<code>string | array</code>)</h2>
<p>Adds a class to the <code>&lt;body class="<strong>my-class</strong>"&gt;</code>.</p>
<pre class="prettyprint linenums">
$this->layout->layout('styles.css');
</pre>

<h2>block (<code>module_name/path_to_file</code> [, <code>array</code>])</h2>
<p>Load a template file (partial view).</code></p>
<pre class="prettyprint linenums">
$this->layout->block('module_name/path-to/file_name');
</pre>
<p>This will load <code>application/modules/<strong>module_name</strong>/views/skin_name/<strong>design/path-to/file_name.php</strong></code>. Please read about the <a href="<?php echo site_url('starting/doc/filesystem') ?>">Layout Module filesystem</a>.</p>

<h2>layout (<code>module_name/path_to_file</code>)</h2>
<p>Defines the layout template that will be used when render.</p>
<pre class="prettyprint linenums">
$this->layout->layout('module_name/file_name');
</pre>
<p>Will search the file on <code>application/modules/<strong>module_name</strong>/views/skin_name/design/</code> directory, like the <code>block()</code> method. The directories structure is a convention, <a href="<?php echo site_url('starting/doc/filesystem') ?>">read more...</a></p>

<h2>render ()</h2>
<p>Render the layout =).</p>
<pre class="prettyprint linenums">
$this->layout->render();
</pre>

<h2>load ([<code>module_name</code>, <code>file_name</code>])</h2>
<p>Load the <a href="<?php echo site_url('starting/doc/load_method_xml_files') ?>">xml layout config</a>.</p>
<pre class="prettyprint linenums">
$this->layout->load('module_name');
</pre>

<h2>set (<code>key</code>, <code>module_name/path_to_file</code>)</h2>
<p>Save a partial view result <code>$this->layout->block('module_name/path_to_file')</code> into a container (the <code>key</code> argument is the container reference).</p>
<pre class="prettyprint linenums">
$this->layout->set('reference', 'header.php');
$this->layout->set('reference', 'body.php');
$this->layout->set('reference', 'footer.php');
</pre>
<p>Will save all that views in a container called 'reference'. Then you can get the 'reference' container and print that blocks at once.</p>

<h2>remove (<code>key</code>, <code>module_name/path_to_file</code>)</h2>
<p>Remove a partial view result <code>$this->layout->block('module_name/path_to_file')</code> from a reference (the <code>key</code> argument is the reference name).</p>
<pre class="prettyprint linenums">
$this->layout->remove('example', 'header.php');
</pre>

<h2>get (<code>key</code>)</h2>
<p>Print all blocks stored in a container reference.</p>
<pre class="prettyprint linenums">
$this->layout->get('reference');
</pre>