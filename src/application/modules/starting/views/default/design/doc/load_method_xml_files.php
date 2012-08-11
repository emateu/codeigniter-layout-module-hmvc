<h1>The load() method and XML layout files</h1>
<br>

<pre class="prettyprint linenums">
// File path: 
// application/modules/<strong>module_name</strong>/controllers/example.php
class Example extends MX_Controller 
{
    public function index () 
    {
        $this->load->module('layout');
        $this->layout->load();
        $this->layout->render();
    }
}
</pre>
<p>When executing the <code>$this->layout->load()</code> method, the Layout Module will search and read the following files in the following order:</p>
<ol>
<li>
<pre>
application/modules/<strong>layout</strong>/views/layout/<strong>default.xml</strong>
</pre>
<p><span class="label">Allways load this xml file. Should have the global config.</span></p>
</li>

<li>
<pre>
application/modules/<strong>module_name</strong>/views/layout/<strong>default.xml</strong>
</pre>
<p><span class="label">Allways load a default.xml file per module. Should have the general module config.</span></p>
</li>

<li>
<pre>
application/modules/<strong>module_name</strong>/views/layout/<strong>example.xml</strong>
</pre>
<p><span class="label">Allways load a controller_name.xml file. Should have the local config. Here is example.xml because our controller class is called 'class Example'.</span></p>
</li>
</ol>

<p>Each file overrides the previus config. For example, if in  <em>application/modules/<strong>module_name</strong>/views/layout/<strong>default.xml</strong></em> we do :</p>
<pre class="prettyprint linenums">
&lt;layout&gt;
    <strong>&lt;default&gt;</strong>
    &lt!-- here it's default because we are in default.xml file --&gt;
        &lt;head&gt;
            &lt;title&gt;Bye Bye World&lt;/title&gt;
        &lt;/head&gt;
    <strong>&lt;/default&gt;</strong>
&lt;/layout&gt;
</pre>

<p>And then in <em>application/modules/<strong>module_name</strong>/views/layout/<strong>example.xml</strong></em> we do :</p>
<pre class="prettyprint linenums">
&lt;layout&gt;
    <strong>&lt;index&gt;</strong>
    &lt!-- here it's index because was loaded by the index() action --&gt;
        &lt;head&gt;
            &lt;title&gt;Hello World&lt;/title&gt;
        &lt;/head&gt;
    <strong>&lt;/index&gt;</strong>
&lt;/layout&gt;
</pre>
<p>The final title will be <code>&lt;title&gt;Hello World&lt;/title&gt;</code>.</p>