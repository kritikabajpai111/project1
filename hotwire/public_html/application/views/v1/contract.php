<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>HWC REST API - Contract - Testing Server</title>
    <link rel="stylesheet" type="text/css" href="/css/default.css"/>
</head>
<body>

<div id="container">
    <h1><span class="header">
        <img src="https://gethotwired.com/images/logo.png" title="Hotwire Communications" alt="Hotwire Communications">
        <span>REST API - Testing Server - Contract</span>
    </span></h1>

    <div id="body">

<h2>Contract</h2>

        <h3>/v1/contract/terms_of_service - [GET]</h3>

        <form id="terms_of_service" action="" method="GET">
            <table>
                <tr>
                    <td colspan=2>Generated Endpoint: </td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div class="endpoint" id="terms_of_service_endpoint">
                        http://<?=$_SERVER['HTTP_HOST']?>/v1/contract/terms_of_service/{language code}/format/{format}
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
                    <td><select name="format" id="terms_of_service_format">
                        <option value="json">json</option>
                        <?/* <option value="xml">xml</option> */?>
                        <option value="generic">generic</option>
                    <select/></td>
                </tr>
                <tr>
                    <td>Language Code (ISO-639-1): </td>
                    <td><input type="text" name="language_code" id="terms_of_service_language_code" value="en"></td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div class="form_feedback hidden" id="terms_of_service_form_feedback">
                        <p class="bg-danger text-danger"><i>(Results displayed here)</i></p>
                    </div>
                    <div class="form_response hidden" id="terms_of_service_form_response">
                        <pre>(Response displayed here)</pre>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2><input type="button" name="submit" id="terms_of_service_submit" value="Get Terms Of Service"></td>
                </tr>
            </table>
        </form>
<br><br>

        <h3>/v1/contract/privacy_policy - [GET]</h3>

        <form id="privacy_policy" action="" method="GET">
            <table>
                <tr>
                    <td colspan=2>Generated Endpoint: </td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div class="endpoint" id="privacy_policy_endpoint">
                        http://<?=$_SERVER['HTTP_HOST']?>/v1/contract/privacy_policy/{language code}/format/{format}
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
                    <td><select name="format" id="privacy_policy_format">
                        <option value="json">json</option>
                        <?/* <option value="xml">xml</option> */?>
                        <option value="generic">generic</option>
                    <select/></td>
                </tr>
                <tr>
                    <td>Language Code (ISO-639-1): </td>
                    <td><input type="text" name="language_code" id="privacy_policy_language_code" value="en"></td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div class="form_feedback hidden" id="privacy_policy_form_feedback">
                        <p class="bg-danger text-danger"><i>(Results displayed here)</i></p>
                    </div>
                    <div class="form_response hidden" id="privacy_policy_form_response">
                        <pre>(Response displayed here)</pre>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2><input type="button" name="submit" id="privacy_policy_submit" value="Get Privacy Policy"></td>
                </tr>
            </table>
        </form>
<br><br>

        <h3>/v1/contract/list - [GET]</h3>

        <form id="list" action="" method="GET">
            <table>
                <tr>
                    <td colspan=2>Generated Endpoint: </td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div class="endpoint" id="list_endpoint">
                        http://<?=$_SERVER['HTTP_HOST']?>/v1/contract/list/format/{format}
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
                    <td><select name="format" id="list_format">
                        <option value="json">json</option>
                        <?/* <option value="xml">xml</option> */?>
                        <option value="generic">generic</option>
                    <select/></td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div class="form_feedback hidden" id="list_form_feedback">
                        <p class="bg-danger text-danger"><i>(Results displayed here)</i></p>
                    </div>
                    <div class="form_response hidden" id="list_form_response">
                        <pre>(Response displayed here)</pre>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2><input type="button" name="submit" id="list_submit" value="Get Contract Codes"></td>
                </tr>
            </table>
        </form>
<br><br>

        <h3>/v1/contract/retrieve - [GET]</h3>

        <form id="retrieve" action="" method="GET">
            <table>
                <tr>
                    <td colspan=2>Generated Endpoint: </td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div class="endpoint" id="retrieve_endpoint">
                        http://<?=$_SERVER['HTTP_HOST']?>/v1/contract/retrieve/{contract code}/{language code}/format/{format}
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
                    <td><select name="format" id="retrieve_format">
                        <option value="json">json</option>
                        <?/* <option value="xml">xml</option> */?>
                        <option value="generic">generic</option>
                    <select/></td>
                </tr>
                <tr>
                    <td>Contract Code: </td>
                    <td><input type="text" name="contract_code" id="retrieve_contract_code" value="tos"></td>
                </tr>
               <tr>
                    <td>Language Code (ISO-639-1): </td>
                    <td><input type="text" name="language_code" id="retrieve_language_code" value="en"></td>
                </tr>
                <tr>
                    <td colspan=2>
                    <div class="form_feedback hidden" id="retrieve_form_feedback">
                        <p class="bg-danger text-danger"><i>(Results displayed here)</i></p>
                    </div>
                    <div class="form_response hidden" id="retrieve_form_response">
                        <pre>(Response displayed here)</pre>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2><input type="button" name="submit" id="retrieve_submit" value="Get Contract"></td>
                </tr>
            </table>
        </form>
<br><br>

    </div>

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
    .on('click', '#terms_of_service_submit', function(){
        $('#terms_of_service_form_feedback').setInfo('Getting Terms Of Service...');
        $('#terms_of_service_form_feedback').show().removeClass('hidden');

		var data = $('#terms_of_service').serializeArray();
 
        var endpoint = '/v1/contract/terms_of_service/'+$('#terms_of_service_language_code').val()+'/format/'+$('#terms_of_service_format').val();
        $('#terms_of_service_endpoint').html('http://<?=$_SERVER['HTTP_HOST']?>'+endpoint);
        $.get(endpoint,data,function(req) {
            if ($('#terms_of_service_format').val()=='generic') {
                if (req.Success=='true'){
                    $('#terms_of_service_form_feedback').setSuccess(req.Message+'');
                } else {
                    $('#terms_of_service_form_feedback').setError(req.ErrorCode+" - "+req.Message);
                }
            }
            else if ($('#terms_of_service_format').val()=='json') {
                if (req.success){
                    $('#terms_of_service_form_feedback').setSuccess(req.success+'');
                } else {
                    $('#terms_of_service_form_feedback').setError(req.error+" - "+req.message);
                }
            }
            var data = JSON.stringify(req, null, '\t');
            $('#terms_of_service_form_response').children().html("Response Data Size: "+data.length+"\n"+data);
		});
 
    })
    .on('click', '#privacy_policy_submit', function(){
        $('#privacy_policy_form_feedback').setInfo('Getting Privacy Policy...');
        $('#privacy_policy_form_feedback').show().removeClass('hidden');

		var data = $('#privacy_policy').serializeArray();
 
        var endpoint = '/v1/contract/privacy_policy/'+$('#privacy_policy_language_code').val()+'/format/'+$('#privacy_policy_format').val();
        $('#privacy_policy_endpoint').html('http://<?=$_SERVER['HTTP_HOST']?>'+endpoint);
        $.get(endpoint,data,function(req) {
            if ($('#privacy_policy_format').val()=='generic') {
                if (req.Success=='true'){
                    $('#privacy_policy_form_feedback').setSuccess(req.Message+'');
                } else {
                    $('#privacy_policy_form_feedback').setError(req.ErrorCode+" - "+req.Message);
                }
            }
            else if ($('#privacy_policy_format').val()=='json') {
                if (req.success){
                    $('#privacy_policy_form_feedback').setSuccess(req.success+'');
                } else {
                    $('#privacy_policy_form_feedback').setError(req.error+" - "+req.message);
                }
            }
            var data = JSON.stringify(req, null, '\t');
            $('#privacy_policy_form_response').children().html("Response Data Size: "+data.length+"\n"+data);
		});
 
    })
    .on('click', '#list_submit', function(){
        $('#list_form_feedback').setInfo('Getting Contract Codes...');
        $('#list_form_feedback').show().removeClass('hidden');

		var data = $('#list').serializeArray();
 
        var endpoint = '/v1/contract/list/format/'+$('#list_format').val();
        $('#list_endpoint').html('http://<?=$_SERVER['HTTP_HOST']?>'+endpoint);
        $.get(endpoint,data,function(req) {
            if ($('#list_format').val()=='generic') {
                if (req.Success=='true'){
                    $('#list_form_feedback').setSuccess(req.Message+'');
                } else {
                    $('#list_form_feedback').setError(req.ErrorCode+" - "+req.Message);
                }
            }
            else if ($('#list_format').val()=='json') {
                if (req.success){
                    $('#list_form_feedback').setSuccess(req.success+'');
                } else {
                    $('#list_form_feedback').setError(req.error+" - "+req.message);
                }
            }
            var data = JSON.stringify(req, null, '\t');
            $('#list_form_response').children().html("Response Data Size: "+data.length+"\n"+data);
		});
 
    })
    .on('click', '#retrieve_submit', function(){
        $('#retrieve_form_feedback').setInfo('Retrieving Contract...');
        $('#retrieve_form_feedback').show().removeClass('hidden');

		var data = $('#retrieve').serializeArray();
 
        var endpoint = '/v1/contract/retrieve/'+$('#retrieve_contract_code').val()+'/'+$('#retrieve_language_code').val()+'/format/'+$('#retrieve_format').val();
        $('#retrieve_endpoint').html('http://<?=$_SERVER['HTTP_HOST']?>'+endpoint);
        $.get(endpoint,data,function(req) {
            if ($('#retrieve_format').val()=='generic') {
                if (req.Success=='true'){
                    $('#retrieve_form_feedback').setSuccess(req.Message+'');
                } else {
                    $('#retrieve_form_feedback').setError(req.ErrorCode+" - "+req.Message);
                }
            }
            else if ($('#retrieve_format').val()=='json') {
                if (req.success){
                    $('#retrieve_form_feedback').setSuccess(req.success+'');
                } else {
                    $('#retrieve_form_feedback').setError(req.error+" - "+req.message);
                }
            }
            var data = JSON.stringify(req, null, '\t');
            $('#retrieve_form_response').children().html("Response Data Size: "+data.length+"\n"+data);
		});

    });

</script>

</body>
</html>
