<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>HWC REST API - Testing Server - User/Contact</title>
    <link rel="stylesheet" type="text/css" href="/css/default.css"/>
</head>
<body>

<div id="container">
    <h1><span class="header">
        <img src="https://gethotwired.com/images/logo.png" title="Hotwire Communications" alt="Hotwire Communications">
        <span>REST API - Testing Server - User/Contact</span>
    </span></h1>

    <div id="body">


        <h3>/v1/user/contact - [GET]</h3>

        <form id="get_contact" action="" method="GET">
            <table>
                <tr>
                    <td colspan=2>Generated Endpoint: </td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div class="endpoint" id="get_contact_endpoint">
                        http://<?=$_SERVER['HTTP_HOST']?>/v1/user/contact/{id}/format/{format}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div>&nbsp;</div>
                    </td>
                </tr>
                <tr>
                    <td>Format: </td>
                    <td><select name="format" id="get_contact_format">
                        <option value="json">json</option>
                        <?/* <option value="xml">xml</option> */?>
                        <option value="generic">generic</option>
                    <select/></td>
                </tr>
                <tr>
                    <td>Contact ID: </td>
                    <td><input type="text" name="get_contact_id" id="get_contact_id" value="24"></td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div class="form_feedback hidden" id="get_contact_form_feedback">
                        <p class="bg-danger text-danger"><i>(Results displayed here)</i></p>
                    </div>
                    <div class="form_response hidden" id="get_contact_form_response">
                        <pre>(Response displayed here)</pre>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2><input type="button" name="submit" id="submit_get_contact" value="Get Contact"></td>
                </tr>
            </table>
        </form>
<br><br>

        <form id="put_contact" action="" method="PUT">
            <table>
                <tr>
                    <td colspan=2>Generated Endpoint: </td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div class="endpoint" id="put_contact_endpoint">
                        http://<?=$_SERVER['HTTP_HOST']?>/v1/user/contact/{id}/{contact content}/format/{format}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div>&nbsp;</div>
                    </td>
                </tr>
                <tr>
                    <td>Format: </td>
                    <td><select name="format" id="put_contact_format">
                        <option value="json">json</option>
                        <?/* <option value="xml">xml</option> */?>
                        <option value="generic">generic</option>
                    <select/></td>
                </tr>
                <tr>
                    <td>Contact ID: </td>
                    <td><input type="text" name="put_contact_id" id="put_contact_id" value="24"></td>
                </tr>
                <tr>
                    <td>Contact Info: </td>
                    <td><input type="text" name="put_contact_content" id="put_contact_content" value="5615551234"></td>
                </tr>
                <tr>
                    <td>Contact Type: </td>
                    <td><input type="text" name="put_contact_type" id="put_contact_type" value="MOBPHONE"></td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div class="form_feedback hidden" id="put_contact_form_feedback">
                        <p class="bg-danger text-danger"><i>(Results displayed here)</i></p>
                    </div>
                    <div class="form_response hidden" id="put_contact_form_response">
                        <pre>(Response displayed here)</pre>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2><input type="button" name="submit" id="submit_put_contact" value="Save Contact"></td>
                </tr>
            </table>
        </form>
<br><br>

        <form id="get_contact_types" action="" method="GET">
            <table>
                <tr>
                    <td colspan=2>Generated Endpoint: </td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div class="endpoint" id="get_contact_types_endpoint">
                        http://<?=$_SERVER['HTTP_HOST']?>/v1/user/contact/types/format/{format}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div>&nbsp;</div>
                    </td>
                </tr>
                <tr>
                    <td>Format: </td>
                    <td><select name="format" id="get_contact_types_format">
                        <option value="json">json</option>
                        <?/* <option value="xml">xml</option> */?>
                        <option value="generic">generic</option>
                    <select/></td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div class="form_feedback hidden" id="get_contact_types_form_feedback">
                        <p class="bg-danger text-danger"><i>(Results displayed here)</i></p>
                    </div>
                    <div class="form_response hidden" id="get_contact_types_form_response">
                        <pre>(Response displayed here)</pre>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2><input type="button" name="submit" id="submit_get_contact_types" value="Get Contact Types"></td>
                </tr>
            </table>
        </form>
<br><br>

<h2><a href="<?php echo site_url('v1/user/contact/validate'); ?>">Validate</a></h2>
    <ul>
        <li>
            /v1/user/contact/validate/phone - [POST]
        </li>
        <li>
            /v1/user/contact/validate/email - [POST]
        </li>
    </ul>

<h2><a href="<?php echo site_url('v1/user/contact/verify'); ?>">Verify</a></h2>
    <ul>
        <li>
            /v1/user/contact/verify/send - [GET/POST]
        </li>
        <li>
            /v1/user/contact/verify/phone - [GET]
        </li>
        <li>
            /v1/user/contact/verify/email - [GET]
        </li>
    </ul>


    </div>

    <p class="footer"></p>
</div>

<script src="https://code.jquery.com/jquery-1.12.0.js"></script>

<script>
        jQuery.fn.extend({
          setError: function(msg) {
              this.children().removeClass('bg-warning').removeClass('text-warning')
                             .removeClass('bg-success').removeClass('text-success')
                             .removeClass('bg-info').removeClass('text-info')
                             .addClass('bg-danger').addClass('text-danger').html(msg);
              this.show().removeClass('hidden');
          },
          setWarning: function(msg) {
              this.children().removeClass('bg-danger').removeClass('text-danger')
                             .removeClass('bg-success').removeClass('text-success')
                             .removeClass('bg-info').removeClass('text-info')
                             .addClass('bg-warning').addClass('text-warning').html(msg);
              this.show().removeClass('hidden');
          },
          setSuccess: function(msg) {
              this.children().removeClass('bg-danger').removeClass('text-danger')
                             .removeClass('bg-warning').removeClass('text-warning')
                             .removeClass('bg-info').removeClass('text-info')
                             .addClass('bg-success').addClass('text-success').html(msg);
              this.show().removeClass('hidden');
          },
          setInfo: function(msg) {
              this.children().removeClass('bg-danger').removeClass('text-danger')
                             .removeClass('bg-warning').removeClass('text-warning')
                             .removeClass('bg-success').removeClass('text-success')
                             .addClass('bg-info').addClass('text-info').html(msg);
              this.show().removeClass('hidden');
          }
        });

$(document)
	.ready(function() { })
    .on('click', '#submit_get_contact_types', function(){
        $('#get_contact_types_form_feedback').setInfo('Getting Contact Types...');
        $('#get_contact_types_form_feedback').show().removeClass('hidden');

		var data = $('#get_contact_types').serializeArray();

        var endpoint = '/v1/user/contact/types/format/'+$('#get_contact_format').val(); //'+$('#password').val()+'
        $('#get_contact_types_endpoint').html('http://<?=$_SERVER['HTTP_HOST']?>'+endpoint);

        $.get(endpoint,null,function(req) {
            if ($('#get_contact_types_format').val()=='generic') {
                if (req.Success=='true'){
                    $('#get_contact_types_form_feedback').setSuccess(req.Message);
                } else {
                    $('#get_contact_types_form_feedback').setError(req.ErrorCode+" - "+req.Message);
                }
            }
            else if ($('#get_contact_types_format').val()=='json') {
                if (req.success){
                    $('#get_contact_types_form_feedback').setSuccess(req.success);
                } else {
                    $('#get_contact_types_form_feedback').setError(req.error+" - "+req.message);
                }
            }
            var data = JSON.stringify(req, null, '\t');
            $('#get_contact_types_form_response').children().html("Response Data Size: "+data.length+"\n"+data);
		});

    })
    .on('click', '#submit_put_contact', function(){
        $('#put_contact_form_feedback').setInfo('Saving Contact...');
        $('#put_contact_form_feedback').show().removeClass('hidden');

		var data = $('#put_contact').serializeArray();

        var endpoint = '/v1/user/contact/'+$('#put_contact_id').val()+'/'+$('#put_contact_content').val()+'/'+$('#put_contact_type').val()+'/format/'+$('#get_contact_format').val(); //'+$('#password').val()+'
        $('#put_contact_endpoint').html('http://<?=$_SERVER['HTTP_HOST']?>'+endpoint);

        $.ajax({
            url: endpoint,
            type: 'PUT',
            success: function(req) {
            if ($('#put_contact_format').val()=='generic') {
                if (req.Success=='true'){
                    $('#put_contact_form_feedback').setSuccess(req.Message);
                } else {
                    $('#put_contact_form_feedback').setError(req.ErrorCode+" - "+req.Message);
                }
            }
            else if ($('#put_contact_format').val()=='json') {
                if (req.success){
                    $('#put_contact_form_feedback').setSuccess(req.success);
                } else {
                    $('#put_contact_form_feedback').setError(req.error+" - "+req.message);
                }
            }
            var data = JSON.stringify(req, null, '\t');
            $('#put_contact_form_response').children().html("Response Data Size: "+data.length+"\n"+data);
            }
        });
    })
        .on('click', '#submit_get_contact', function(){
        $('#get_contact_form_feedback').setInfo('Getting Contact...');
        $('#get_contact_form_feedback').show().removeClass('hidden');

		var data = $('#get_contact').serializeArray();

        var endpoint = '/v1/user/contact/'+$('#get_contact_id').val()+'/format/'+$('#get_contact_format').val(); //'+$('#password').val()+'
        $('#get_contact_endpoint').html('http://<?=$_SERVER['HTTP_HOST']?>'+endpoint);

        $.get(endpoint,null,function(req) {
            if ($('#get_contact_format').val()=='generic') {
                if (req.Success=='true'){
                    $('#get_contact_form_feedback').setSuccess(req.Message);
                } else {
                    $('#get_contact_form_feedback').setError(req.ErrorCode+" - "+req.Message);
                }
            }
            else if ($('#get_contact_format').val()=='json') {
                if (req.success){
                    $('#get_contact_form_feedback').setSuccess(req.success);
                } else {
                    $('#get_contact_form_feedback').setError(req.error+" - "+req.message);
                }
            }
            var data = JSON.stringify(req, null, '\t');
            $('#get_contact_form_response').children().html("Response Data Size: "+data.length+"\n"+data);
		});

    });

</script>

</body>
</html>
