jQuery(document).ready(function(){
  columnWidthOptions = {
    min: 0,
    max: 12,
    step: 1
  }

  initSlider();

});

function initSlider(prefix) {
  prefix = typeof prefix == 'undefined' ? '' : prefix+'-' ;
  console.log("test"+prefix+"test");
  if(columnCount == 2) {
    places = [
      [jQuery("form input[name='col1-width']"),jQuery("#col-width-labels .col-1-width")],
      [jQuery("form input[name='col2-width']"),jQuery("#col-width-labels .col-2-width")],
    ];
    columnWidthOptions['value'] = '6';
    columnWidthOptions['slide'] = function(event,ui) {
      setValues(calcValues([ui.value]),places);
    }
    setValues(calcValues([6]),places);
  }else if(columnCount == 3) {
    places = [
      [jQuery("form input[name='col1-width']"),jQuery("#col-width-labels .col-1-width")],
      [jQuery("form input[name='col2-width']"),jQuery("#col-width-labels .col-2-width")],
      [jQuery("form input[name='col3-width']"),jQuery("#col-width-labels .col-3-width")],
    ];
    columnWidthOptions['values'] = ['4','8'];
    columnWidthOptions['slide'] = function(event,ui) {
      if(ui.values[0] > ui.values[1])
        return false;

      setValues(calcValues(ui.values),places);

    }
    setValues(calcValues([3,6,9]),places);
  }else if(columnCount == 4) {
    places = [
      [jQuery("form input[name='col1-width']"),jQuery("#col-width-labels .col-1-width")],
      [jQuery("form input[name='col2-width']"),jQuery("#col-width-labels .col-2-width")],
      [jQuery("form input[name='col3-width']"),jQuery("#col-width-labels .col-3-width")],
      [jQuery("form input[name='col4-width']"),jQuery("#col-width-labels .col-4-width")]
    ];
    columnWidthOptions['values'] = ['3','6','9'];
    columnWidthOptions['slide'] = function(event,ui) {
      if(ui.values[0] > ui.values[1] || ui.values[1] > ui.values[2])
        return false;

      setValues(calcValues(ui.values),places);

    }
    setValues(calcValues([3,6,9]),places);
  }

  jQuery('#col-width-slider').slider(columnWidthOptions);
}

function setValues(values,places) {
  for(i=0;i<places.length;i++) {
    places[i][0].val(values[i]);
    places[i][1].html(values[i]);
  }
}

function calcValues(values) {
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
