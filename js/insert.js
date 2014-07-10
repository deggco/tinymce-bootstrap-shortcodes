jQuery(document).ready(function(){

  initSlider();

  jQuery('#responsive-design').click(function(obj) {
    if(obj.target.checked) {
      initSlider("xs");
      initSlider("sm");
      initSlider("md");
      initSlider("lg");
      jQuery("#responsive-design-sliders").css('display','block');
      jQuery("#nonresponsive-sliders").css('display','none');
    }else{
      jQuery("#responsive-design-sliders").css('display','none');
      jQuery("#nonresponsive-sliders").css('display','block');
    }
  });

});

function initSlider(prefix) {
  var columnWidthOptions = {
    min: 0,
    max: 12,
    step: 1
  }
  var prefix = typeof prefix == 'undefined' ? '' : prefix+'-' ;
  if(columnCount == 2) {
    var places = [
      [jQuery("form input[name='"+prefix+"col1-width']"),jQuery("#"+prefix+"col-width-labels ."+prefix+"col-1-width")],
      [jQuery("form input[name='"+prefix+"col2-width']"),jQuery("#"+prefix+"col-width-labels ."+prefix+"col-2-width")],
    ];
    columnWidthOptions['value'] = '6';
    columnWidthOptions['slide'] = function(event,ui) {
      setValues(calcValues([ui.value],columnWidthOptions),places);
    }
    setValues(calcValues([6],columnWidthOptions),places);
  }else if(columnCount == 3) {
    var places = [
      [jQuery("form input[name='"+prefix+"col1-width']"),jQuery("#"+prefix+"col-width-labels ."+prefix+"col-1-width")],
      [jQuery("form input[name='"+prefix+"col2-width']"),jQuery("#"+prefix+"col-width-labels ."+prefix+"col-2-width")],
      [jQuery("form input[name='"+prefix+"col3-width']"),jQuery("#"+prefix+"col-width-labels ."+prefix+"col-3-width")],
    ];
    columnWidthOptions['values'] = ['4','8'];
    columnWidthOptions['slide'] = function(event,ui) {
      if(ui.values[0] > ui.values[1])
        return false;

      setValues(calcValues(ui.values,columnWidthOptions),places);

    }
    setValues(calcValues([4,8],columnWidthOptions),places);
  }else if(columnCount == 4) {
    var places = [
      [jQuery("form input[name='"+prefix+"col1-width']"),jQuery("#"+prefix+"col-width-labels ."+prefix+"col-1-width")],
      [jQuery("form input[name='"+prefix+"col2-width']"),jQuery("#"+prefix+"col-width-labels ."+prefix+"col-2-width")],
      [jQuery("form input[name='"+prefix+"col3-width']"),jQuery("#"+prefix+"col-width-labels ."+prefix+"col-3-width")],
      [jQuery("form input[name='"+prefix+"col4-width']"),jQuery("#"+prefix+"col-width-labels ."+prefix+"col-4-width")]
    ];
    columnWidthOptions['values'] = ['3','6','9'];
    columnWidthOptions['slide'] = function(event,ui) {
      if(ui.values[0] > ui.values[1] || ui.values[1] > ui.values[2])
        return false;

      setValues(calcValues(ui.values,columnWidthOptions),places);

    }
    setValues(calcValues([3,6,9],columnWidthOptions),places);
  }

  jQuery('#'+prefix+'col-width-slider').slider(columnWidthOptions);
}

function setValues(values,placesArray) {
  for(i=0;i<placesArray.length;i++) {
    placesArray[i][0].val(values[i]);
    placesArray[i][1].html(values[i]);
  }
}

function calcValues(values,columnWidthOptions) {
  distance = [];
  for(i=0;i<columnCount;i++) {
    if(i == 0)
      distance.push(values[i] - columnWidthOptions['min']);
    else if(columnCount - i == 1)
      distance.push(columnWidthOptions['max'] - values[i-1]) ;
    else
      distance.push(values[i] - values[i-1]);
  }
  return distance
}

function processForm(obj) {
  
}

function generateShortcode() {

}
