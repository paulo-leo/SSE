const $sse = {};
$sse.actions = {};
$sse.json = {};
$sse.optionsURL = {};
$sse.error = function(e){  };
$sse.options = function(v)
{
  $sse.optionsURLs = v;
};
$sse.has = function(key){
return $sse.json.hasOwnProperty(key);
};
$sse.var = function(key,def=''){
return $sse.has(key) ? $sse.json[key] : def;
};
$sse.int = function(k){
          let x = $sse.var(k,0);
          return !isNaN(x) ? parseInt(x) : 0;
        };
        $sse.float = function(k){
          let x = $sse.var(k,0);
          return !isNaN(x) ? parseFloat(x) : 0.0;
        };
        $sse.array = function(k){
          let x = $sse.var(k,[]);
          return Array.isArray(x) ? x : [];
        };
        $sse.object = function(k){
          var x = $sse.var(k,{});
          try { 
             x = JSON.parse(x); }
          catch (e){
               if(typeof x !== 'object' && x === null) x = {};
          }
          return x;
        };
        $sse.action = function(key,value){
          $sse.actions[key] = value;
        };
        $sse.selector = "body";
        $sse.el = function(el){
          $sse.selector = el;
        };
        $sse.setVar = function(key,val){
          let str = document.querySelector($sse.selector).innerHTML; 
          let res = str.replaceAll("${"+key+"}", val);
          document.querySelector($sse.selector).innerHTML = res;
        };
        $sse.support = function(){
          return (typeof EventSource !== "undefined") ? true : false;
        };
        $sse.success = function(e){};
        $sse.url = function(url)
        {
          $sse.get = new EventSource(url,$sse.optionsURL);
          $sse.get.onmessage = function (event)
          {
             var data = JSON.parse(event.data);
             $sse.json = data;
             $sse.success(data);
             if(data.hasOwnProperty('event_action'))
             {
               if($sse.actions.hasOwnProperty(data['event_action'])){
                  let action = data['event_action'];
                  $sse.actions[action](data); 
               }
             }
          };
          $sse.get.onerror = function(event)
          {
              $sse.error(event);
          };
        };
