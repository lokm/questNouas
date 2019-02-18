var configTimer = {
    "count_past_zero": false,
    "animation": "smooth",
    "bg_width": 1.2,
    "fg_width": 0.1,
    "circle_bg_color": "#60686F",
    "time": {
        "Days": {
            "text": "Days",
            "color": "#FFCC66",
            "show": false
        },
        "Hours": {
            "text": "Hours",
            "color": "rgb(126, 206, 253)",
            "show": false
        },
        "Minutes": {
            "text": "Minutes",
            "color": "rgb(126, 206, 253)",
            "show": true
        },
        "Seconds": {
            "text": "Seconds",
            "color": "rgb(126, 206, 253)",
            "show": true
        }
    }
};

var configTimerListen = function(unit,value,total) {
    
        if(value == 0){
            
            //Trigger the click event here
           $('.question:first').find('.btnSubmit:first').click();
        
               
            }
};

$("#timer").data('timer',100).TimeCircles(configTimer).addListener(configTimerListen);

/*$('.btnSubmit')
    .parents('form:first').filter(function() {
                return $(this).css('display') == 'block';
             })
    .find('.btnSubmit:first')
    .on('click', function(event) {
        //tmp = tmp.toString();
        $("#timer").data('timer', 3).TimeCircles().start();
    });*/

