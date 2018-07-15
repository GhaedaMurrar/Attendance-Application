
		var call1 ; // calling validation for add section
		var  addArr = new Array();
        var letters = /^[A-Za-z]+$/;

jQuery(document).ready(function() {

    var activeTab= jQuery('.tabs .tab-links li.active a').attr('id');
    console.log(activeTab);
              if ( activeTab == 'addSection')
              {
                console.log("add tab clicked");
                 call1 = setInterval (add , 300);
              }

    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).fadeIn(400).siblings().hide();
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

        e.preventDefault();
    });
});

/*---------------------- input file --------------------*/
var inputs = document.querySelectorAll( '.inputfile' );
Array.prototype.forEach.call( inputs, function( input )
{
	var label	 = input.nextElementSibling,
		labelVal = label.innerHTML;

	input.addEventListener( 'change', function( e )
	{
		var fileName = '';

			fileName = e.target.value.split( '\\' ).pop();

		if( fileName )
			label.querySelector( 'span' ).innerHTML = fileName;
		else
			label.innerHTML = labelVal;
	});
});

/*-----------------------validation -Add Section-  -------------------------*/
		 function add(){

		 	  validateCourseId();
		 	  validateSectionId();
		 	   console.log('im in add Section');
	              if(add[1] && add[2])
	                {
	                    document.getElementById('addbtn').disabled = false ;
	                    console.log(add[1] && add[2] );
	                    console.log('Im enable now') ;
	                }
	                else
	                {
	                    document.getElementById('addbtn').disabled = true ;
	                    console.log(add[1] && add[2]);
                        console.log('Im unenable now') ;
	                }
        }


        function validateCourseId() {
            var CourseId = document.getElementById('CourseId');
            var cn=document.forms["AddSection"]["CourseId"].value;
            CourseId.addEventListener("keyup", function (event) {
               if (document.forms["AddSection"]["CourseId"].value=="")
                    {
                        document.getElementById('form-group-course-id').className = "form-group has-error has-feedback";
                        document.getElementById('form-span-course-id').className = "glyphicon glyphicon-remove form-control-feedback";
                        console.log('Required !');
                        add[1]=0 ;
                    }
                    else if (document.getElementById('CourseId').value.match(letters))
                    {
                        document.getElementById('form-group-course-id').className = "form-group has-error has-feedback";
                        document.getElementById('form-span-course-id').className = "glyphicon glyphicon-remove form-control-feedback";
                        console.log('not valid should be integer');
                        add[1]=0 ;
                    }
                     else 
                    {
                        document.getElementById('form-group-course-id').className = "form-group has-success has-feedback";
                        document.getElementById('form-span-course-id').className = "glyphicon glyphicon-ok form-control-feedback";
                        console.log('true');
                        add[1]=1 ;
                    }
                    }, false);
        }

         function validateSectionId() {
            var SectionId = document.getElementById('Sectionid');
            var sn=document.forms["AddSection"]["Sectionid"].value;
            SectionId.addEventListener("keyup", function (event) {
               if (document.forms["AddSection"]["Sectionid"].value=="")
                    {
                        document.getElementById('form-group-section-id').className = "form-group has-error has-feedback";
                        document.getElementById('form-span-section-id').className = "glyphicon glyphicon-remove form-control-feedback";
                        console.log('Required !');
                        add[2]=0 ;
                    }
                    else if (document.getElementById('Sectionid').value.match(letters))
                    {
                        document.getElementById('form-group-section-id').className = "form-group has-error has-feedback";
                        document.getElementById('form-span-section-id').className = "glyphicon glyphicon-remove form-control-feedback";
                        console.log('not valid should be integer');
                        add[2]=0 ;
                    }
                     else 
                    {
                        document.getElementById('form-group-section-id').className = "form-group has-success has-feedback";
                        document.getElementById('form-span-section-id').className = "glyphicon glyphicon-ok form-control-feedback";
                        console.log('true');
                        add[2]=1 ;
                    }
                    }, false);
        }


        function clearDeleteSection(){

            $("#form-group-course-id").val('');
                    document.getElementById('form-group-first-name').className = "";
                    document.getElementById('form-span-first-name').className = "";

                    $("#SecondName").val('');
                    document.getElementById('form-group-second-name').className = "";
                    document.getElementById('form-span-second-name').className = "";

                    $("#id").val('');
                    document.getElementById('form-group-id').className = "";
                    document.getElementById('form-span-id').className = "";

        }