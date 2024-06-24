
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>jQuery vSelect Custom Select Plugin Examples</title>
<style>
  html,* { font-family: 'Inter'; box-sizing: border-box; }
body { background-color: #fafafa; line-height:1.6;}
.lead { font-size: 1.5rem; font-weight: 300; }
.container { margin: 30px auto; max-width: 960px; }
</style>
<link rel="stylesheet" href="vselect/vselect.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="vselect/vselect.js"></script>

</head>

<body>
<div class="container">
  <h1>jQuery vSelect Custom Select Plugin Examples</h1>
  <style>
.download{ padding: 1.25rem; border:0; border-radius:3px; background-color:#4F46E5; color:#fff;cursor:pointer; text-decoration:none;}.download:hover{color: #fff}#carbonads{display:block;overflow:hidden;max-width:728px;position:relative;font-size:22px;box-sizing:content-box}#carbonads>span{display:block}#carbonads a{color:#4F46E5;text-decoration:none}#carbonads a:hover{color:#4F46E5}.carbon-wrap{display:flex;align-items:center}.carbon-img{display:block;margin:0;line-height:1}.carbon-img img{display:block;height:90px;width:auto}.carbon-text{display:block;padding:0 1em;line-height:1.35;text-align:left}.carbon-poweredby{display:block;position:absolute;bottom:0;right:0;padding:6px 10px;text-align:center;text-transform:uppercase;letter-spacing:.5px;font-weight:600;font-size:8px;border-top-left-radius:4px;line-height:1;color:#aaa!important}@media only screen and (min-width:320px) and (max-width:759px){.carbon-text{font-size:14px}}
</style>
<div><div id="carbon-block"></div><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2783044520727903"
     crossorigin="anonymous"></script>
<!-- jQuery_Replace_Demo -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-2783044520727903"
     data-ad-slot="7325992188"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script></div>
<p style="margin:2rem auto"><a class="download" href="https://www.jqueryscript.net/form/enhance-native-select-box.html">Download This Plugin</a> <a class="download" href="https://www.jqueryscript.net/">Back To jQueryScript</a></p>
  <p class="lead">A custom select jQuery plugin that reinvents the native select boxes with a customizable, user-friendly dropdown for a better navigating/browsing experience.</p>
  <h2>Default Options</h2>
  <select name="fruit" id="demo-1" multiple>
  <optgroup label="Fruits">
    <option value="apple">Apple</option>
    <option value="banana">Banana</option>
    <option value="orange">Orange</option>
    <option value="grapefruit">Grapefruit</option>
    <option value="lemon">Lemon</option>
    <option value="lime">Lime</option>
    <option value="mango">Mango</option>
    <option value="melon">Melon</option>
    <option value="peach">Peach</option>
    <option value="pear">Pear</option>
  </optgroup>
  <optgroup label="Vegetables">
    <option value="carrot">Carrot</option>
    <option value="celery">Celery</option>
    <option value="cucumber">Cucumber</option>
    <option value="eggplant">Eggplant</option>
    <option value="green beans">Green Beans</option>
    <option value="lettuce">Lettuce</option>
    <option value="mushrooms">Mushrooms</option>
    <option value="onion">Onion</option>
    <option value="peppers">Peppers</option>
    <option value="potato">Potato</option>
  </optgroup>
  <optgroup label="Meat">
    <option value="beef">Beef</option>
    <option value="chicken">Chicken</option>
    <option value="fish">Fish</option>
    <option value="lamb">Lamb</option>
    <option value="pork">Pork</option>
    <option value="tofu">Tofu</option>
  </optgroup>
  <optgroup label="Dairy">
    <option value="cheese">Cheese</option>
    <option value="eggs">Eggs</option>
    <option value="milk">Milk</option>
    <option value="yogurt">Yogurt</option>
  </optgroup>
  <optgroup label="Grains">
    <option value="bread">Bread</option>
    <option value="cereal">Cereal</option>
    <option value="pasta">Pasta</option>
    <option value="rice">Rice</option>
  </optgroup>
</select>
<h2>Display mode: "values"</h2>
  <select name="fruit" id="demo-2" multiple>
  <optgroup label="Fruits">
    <option value="apple">Apple</option>
    <option value="banana">Banana</option>
    <option value="orange">Orange</option>
    <option value="grapefruit">Grapefruit</option>
    <option value="lemon">Lemon</option>
    <option value="lime">Lime</option>
    <option value="mango">Mango</option>
    <option value="melon">Melon</option>
    <option value="peach">Peach</option>
    <option value="pear">Pear</option>
  </optgroup>
  <optgroup label="Vegetables">
    <option value="carrot">Carrot</option>
    <option value="celery">Celery</option>
    <option value="cucumber">Cucumber</option>
    <option value="eggplant">Eggplant</option>
    <option value="green beans">Green Beans</option>
    <option value="lettuce">Lettuce</option>
    <option value="mushrooms">Mushrooms</option>
    <option value="onion">Onion</option>
    <option value="peppers">Peppers</option>
    <option value="potato">Potato</option>
  </optgroup>
  <optgroup label="Meat">
    <option value="beef">Beef</option>
    <option value="chicken">Chicken</option>
    <option value="fish">Fish</option>
    <option value="lamb">Lamb</option>
    <option value="pork">Pork</option>
    <option value="tofu">Tofu</option>
  </optgroup>
  <optgroup label="Dairy">
    <option value="cheese">Cheese</option>
    <option value="eggs">Eggs</option>
    <option value="milk">Milk</option>
    <option value="yogurt">Yogurt</option>
  </optgroup>
  <optgroup label="Grains">
    <option value="bread">Bread</option>
    <option value="cereal">Cereal</option>
    <option value="pasta">Pasta</option>
    <option value="rice">Rice</option>
  </optgroup>
</select>
<h2>Inline Block</h2>
  <select name="fruit" id="demo-3" multiple>
  <optgroup label="Fruits">
    <option value="apple">Apple</option>
    <option value="banana">Banana</option>
    <option value="orange">Orange</option>
    <option value="grapefruit">Grapefruit</option>
    <option value="lemon">Lemon</option>
    <option value="lime">Lime</option>
    <option value="mango">Mango</option>
    <option value="melon">Melon</option>
    <option value="peach">Peach</option>
    <option value="pear">Pear</option>
  </optgroup>
  <optgroup label="Vegetables">
    <option value="carrot">Carrot</option>
    <option value="celery">Celery</option>
    <option value="cucumber">Cucumber</option>
    <option value="eggplant">Eggplant</option>
    <option value="green beans">Green Beans</option>
    <option value="lettuce">Lettuce</option>
    <option value="mushrooms">Mushrooms</option>
    <option value="onion">Onion</option>
    <option value="peppers">Peppers</option>
    <option value="potato">Potato</option>
  </optgroup>
  <optgroup label="Meat">
    <option value="beef">Beef</option>
    <option value="chicken">Chicken</option>
    <option value="fish">Fish</option>
    <option value="lamb">Lamb</option>
    <option value="pork">Pork</option>
    <option value="tofu">Tofu</option>
  </optgroup>
  <optgroup label="Dairy">
    <option value="cheese">Cheese</option>
    <option value="eggs">Eggs</option>
    <option value="milk">Milk</option>
    <option value="yogurt">Yogurt</option>
  </optgroup>
  <optgroup label="Grains">
    <option value="bread">Bread</option>
    <option value="cereal">Cereal</option>
    <option value="pasta">Pasta</option>
    <option value="rice">Rice</option>
  </optgroup>
</select>
<h2>Callback</h2>
  <select name="fruit" id="demo-4" multiple>
  <optgroup label="Fruits">
    <option value="apple">Apple</option>
    <option value="banana">Banana</option>
    <option value="orange">Orange</option>
    <option value="grapefruit">Grapefruit</option>
    <option value="lemon">Lemon</option>
    <option value="lime">Lime</option>
    <option value="mango">Mango</option>
    <option value="melon">Melon</option>
    <option value="peach">Peach</option>
    <option value="pear">Pear</option>
  </optgroup>
  <optgroup label="Vegetables">
    <option value="carrot">Carrot</option>
    <option value="celery">Celery</option>
    <option value="cucumber">Cucumber</option>
    <option value="eggplant">Eggplant</option>
    <option value="green beans">Green Beans</option>
    <option value="lettuce">Lettuce</option>
    <option value="mushrooms">Mushrooms</option>
    <option value="onion">Onion</option>
    <option value="peppers">Peppers</option>
    <option value="potato">Potato</option>
  </optgroup>
  <optgroup label="Meat">
    <option value="beef">Beef</option>
    <option value="chicken">Chicken</option>
    <option value="fish">Fish</option>
    <option value="lamb">Lamb</option>
    <option value="pork">Pork</option>
    <option value="tofu">Tofu</option>
  </optgroup>
  <optgroup label="Dairy">
    <option value="cheese">Cheese</option>
    <option value="eggs">Eggs</option>
    <option value="milk">Milk</option>
    <option value="yogurt">Yogurt</option>
  </optgroup>
  <optgroup label="Grains">
    <option value="bread">Bread</option>
    <option value="cereal">Cereal</option>
    <option value="pasta">Pasta</option>
    <option value="rice">Rice</option>
  </optgroup>
</select>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="vselect/vselect.js"></script>
<script>
  
  $('#demo-2').vSelect({
     display: 'values',
     // allows multiselect

  multiSelect:true,

  // custom placeholder

  placeholder:'Please select',

  // enable Check All checkbox

  checkAll:true,

  checkAllLabel:'All',

  // xpand all option groups on load

  expanded:true,

  // or "values"

  display:'sum',

  // height of the dropdown

  trayHeight:'240px',

  // false = make the dropdown inline block

  dropdown:true,

  // allows to search options
  search:true,
  });
  $('#example').vSelect({

  // allows multiselect

  multiSelect:true,

  // custom placeholder

  placeholder:'Please select',

  // enable Check All checkbox

  checkAll:true,

  checkAllLabel:'All',

  // xpand all option groups on load

  expanded:true,

  // or "values"

  display:'sum',

  // height of the dropdown

  trayHeight:'240px',

  // false = make the dropdown inline block

  dropdown:true,

  // allows to search options
  search:true,
});
 
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-1VDDWMRSTH"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-1VDDWMRSTH');
</script>
<script>
try {
  fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
    return true;
  }).catch(function(e) {
    var carbonScript = document.createElement("script");
    carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
    carbonScript.id = "_carbonads_js";
    document.getElementById("carbon-block").appendChild(carbonScript);
  });
} catch (error) {
  console.log(error);
}
</script>
</body>
</html>
