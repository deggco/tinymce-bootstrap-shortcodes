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

  jQuery('#responsive-design').attr('checked',false);

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

  var responsive = jQuery("#responsive-design")[0].checked;
  
  var data = {
    text: {
      "1": jQuery("textarea[name='col1-text']").val(),
      "2": jQuery("textarea[name='col2-text']").val()
    },
    responsive: responsive,
  }

  if(columnCount > 2)
    data["text"]["3"] = jQuery("textarea[name='col3-text']").val();
  if(columnCount > 3)
    data["text"]["4"] = jQuery("textarea[name='col4-text']").val();

  if(responsive) {
    var size = {
      xs: {
        '1': jQuery("input[name='xs-col1-width']").val(),
        '2': jQuery("input[name='xs-col2-width']").val()
      },
      sm: {
        '1': jQuery("input[name='sm-col1-width']").val(),
        '2': jQuery("input[name='sm-col2-width']").val()
      },
      md: {
        '1': jQuery("input[name='md-col1-width']").val(),
        '2': jQuery("input[name='md-col2-width']").val()
      },
      lg: {
        '1': jQuery("input[name='lg-col1-width']").val(),
        '2': jQuery("input[name='lg-col2-width']").val()
      }
    }
    if(columnCount > 2) {
      size['xs']['3'] = jQuery("input[name='xs-col3-width']").val();
      size['sm']['3'] = jQuery("input[name='sm-col3-width']").val();
      size['md']['3'] = jQuery("input[name='md-col3-width']").val();
      size['lg']['3'] = jQuery("input[name='lg-col3-width']").val();
    }if(columnCount > 3) {
      size['xs']['4'] = jQuery("input[name='xs-col4-width']").val();
      size['sm']['4'] = jQuery("input[name='sm-col4-width']").val();
      size['md']['4'] = jQuery("input[name='md-col4-width']").val();
      size['lg']['4'] = jQuery("input[name='lg-col4-width']").val();
    }
    data.size = size;
  }else{
    var size = {
      '1': jQuery("input[name='col1-width']").val(),
      '2': jQuery("input[name='col2-width']").val()
    }

    if(columnCount > 2)
      size['3'] = jQuery("input[name='col3-width']").val();
    if(columnCount > 3)
      size['4'] = jQuery("input[name='col4-width']").val();

    data["size"] = size;
  }

  console.log(generateShortcode(data));

  return false;
  
}

function generateShortcode(data) {

  shortcode = "[row]";
  sizes = ['xs','sm','md','lg'];

  for(i=0;i<columnCount;i++) {
    classes = ""
    if(data['responsive']) {
      for(j=0;j<4;j++) {
        size = data["size"][sizes[j]][i+1];
        if(size == 0)
          classes += "hidden-"+sizes[j] + " ";
        else
          classes += "col-"+sizes[j]+"-"+size;
        if(4 - j !== 1)
          classes += " ";
      }
    }else{
      classes += "col-xs-"+data["size"][i+1];
    }
    shortcode += "[col class=\""+classes+"\"]"+data["text"][i+1]+"[/col]";
  }

  shortcode += "[/row]";

  return shortcode;

}
