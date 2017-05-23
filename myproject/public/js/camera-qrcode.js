 $('#qr-canvas').WebCodeCam({
            ReadQRCode: true, // false or true
            width: 320,
            height: 240,
            videoSource: {  
                    id: true,      //default Videosource
                    maxWidth: 640, //max Videosource resolution width
                    maxHeight: 480 //max Videosource resolution height
            },
            flipVertical: false,  // false or true
            flipHorizontal: false,  // false or true
            zoom: -1, // if zoom = -1, auto zoom for optimal resolution else int
            beep: "js/beep.mp3", // string, audio file location
            autoBrightnessValue: false, // functional when value autoBrightnessValue is int
            brightness: 0, // int 
            grayScale: false, // false or true
            contrast: 0, // int 
            threshold: 0, // int 
            sharpness: [], //or matrix, example for sharpness ->  [0, -1, 0, -1, 5, -1, 0, -1, 0]
            resultFunction: function(resText, lastImageSrc) {
          
                        if(resText){
                        	
                            $('#send').val(resText);
                            $(".submit").click(); 
                        }
                         
            },
            getUserMediaError: function() {
                       
            },
            cameraError: function(error) {
                        
            }
                        
        });