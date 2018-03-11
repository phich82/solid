<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Promotion</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" />
</head>
<body>
    <div class="container">
        <h1>Create Promotion</h1>
        <p>
            <a href="/promotions" class="btn btn-primary"><i class="glyphicon glyphicon-backward"></i> Go Back</a>
        </p>
        <form action="{{ route('promotions.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="col-md-12">
                <div class="form-group">
                    <label for="promotionName">Promotion Name<span style="color:red;">*</span></label>
                    <input type="text" name="promotionName" placeholder="Promotion Name" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="planStartDate">Plan Start Date<span style="color:red;">*</span></label>
                    <div class='input-group date' id='datepicker'>
                        <input type="text" name="planStartDate" placeholder="yyyy-mm-dd" class="form-control" style="border-right:none;">
                        <span class="input-group-addon" style="border-left:none;background-color:#FFFFFF;">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                    <div class="form-group">
                        <label for="amount">Amount Per Mile<span style="color:red;">*</span></label>
                        <input type="text" name="amount" placeholder="Enter a numeric value" class="form-control">
                    </div>
                </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="mileType">Mile Type<span style="color:red;">*</span></label>
                    <select name="mileType" class="form-control">
                        <option value="">Select One...</option>
                        <option value="1">Activity</option>
                        <option value="2">Area</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary btnSave" disabled="disbabled">Save</button>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
        "use strict";

        var Helper = (function () {
            function Helper() {}

            Helper.prototype.isNumeric = function (n) {
                return !isNaN(parseFloat(n)) && isFinite(n);
            };

            Helper.prototype.isNumber = function (n) {
                return isFinite(n) && +n === n;
            };

            Helper.prototype.isInteger = function (n) {
                return n;
            };

            Helper.prototype.removeElement = function (ele, array) {
                var pos = array.indexOf(ele);
                if (pos > -1) array.splice(pos, 1);
            };

            Helper.prototype.isValidDate = function (d) {
                var o = new Date(d.toString());
                return !isNaN(o.getMonth()) ? true : false;
            };

            Helper.prototype.validateDate = function (d, format) {
                if (typeof d !== 'string') return false;

                if (this.isValidDate(d)) {

                }
                return false;
            };

            Helper.prototype.date_format = function (dateStr, formatStr) {
                //Parameters must be a string
                if (typeof dateStr !== 'string') return null;
              
                // format non-empty
                if (formatStr) if (typeof formatStr !== 'string') return null;
                else return dateStr;           

                //Create data for outputing
                var data = Helper.getDataFromDateTime(dateStr); 

                //format of datetime wrong        
                if (!data) return null;    

                //Get the format parts of datetime
                var formatParts = Helper.getFormatPartsFromFormatStr(formatStr.trim()); 
                //Check valid for the format parts?
                if (!formatParts) return null; //invalid formats        

                var out = [];
                formatParts.forEach(function (formatPart) {
                    var formatTypesSumbols = Helper.getFormatTypesAndSymbols(formatPart);
                    if (formatTypesSumbols) out.push(formatTypesSumbols);               
                });

                if (out.length <= 0) return null;

                var result = '';
                out.forEach(function (thisPart, indexOut) {
                    thisPart.types.forEach(function (type, indexIn) {            
                        result += data[type] + (thisPart.symbols.length > 0 && thisPart.symbols.length >= (indexIn + 1) ? thisPart.symbols[indexIn] : '');
                    });
                    //add WS if the format string have two parts (date & time)
                    result += (indexOut % 2 === 0) ? ' ' : ''; 
                });
                return result.trim();
            };
            
            Helper.prototype.getDataFromDateTime = function (dateStr) {
                dateStr = dateStr.trim();
                var d   = new Date(dateStr); //create datetime by number of miliseconds

                //Check valid date?
                //invalid d => d.getDate(): return NaN (number)
                if (!d.getDate()) return null;

                //Get each part of datetime
                var day    = d.getDate();
                var month  = d.getMonth() + 1; // because JS start month from 0 (zero)
                var year   = d.getFullYear();
                var hour   = d.getHours();
                var minute = d.getMinutes();
                var second = d.getSeconds();

                return {
                    'DD'  : day < 10 ? '0' + day.toString() : day.toString(),
                    'dd'  : day < 10 ? '0' + day.toString() : day.toString(),
                    'D'   : day.toString(),
                    'd'   : day.toString(),
                    'MM'  : month < 10 ? '0' + month.toString() : month.toString(),
                    'mm'  : month < 10 ? '0' + month.toString() : month.toString(),
                    'M'   : month.toString(),
                    'm'   : month.toString(),
                    'YY'  : year.toString().substring(2),
                    'yy'  : year.toString().substring(2),
                    'yyyy': year.toString(),
                    'YYYY': year.toString(),
                    'HH'  : hour < 10 ? '0' + hour.toString() : hour.toString(),
                    'hh'  : hour < 10 ? '0' + hour.toString() : hour.toString(),
                    'H'   : hour.toString(),
                    'h'   : hour.toString(),
                    'II'  : minute < 10 ? '0' + minute.toString() : minute.toString(),
                    'ii'  : minute < 10 ? '0' + minute.toString() : minute.toString(),
                    'I'   : minute.toString(),
                    'i'   : minute.toString(),            
                    'SS'  : second < 10 ? '0' + second.toString() : second.toString(), 
                    'ss'  : second < 10 ? '0' + second.toString() : second.toString(), 
                    'S'   : second.toString(),   
                    's'   : second.toString()       
                };
            };
            
            Helper.prototype.getFormatPartsFromFormatStr = function (formatStr) { 
                //dd | dd/mm | dd/mm/yyyy | hh | hh/ii | hh/ii/ss
                //w+ (lower): extract dd, mm, yyyy
                //W+ (upper): extract symbols
                var patternTest = /(\s)*[\w+]{1,4}(\s)*(\W+[\w+]{1,4}(\s)*(\W+[\w+]{1,4}(\s)*)?)?/gi;

                //validate format string 
                if (Helper.validateDateTimeFormatStr(formatStr)) {        
                    var formatParts = formatStr.match(patternTest);           
                    var out = [];
                    
                    if (formatParts){
                        formatParts.forEach(function (formatPart) {
                            out.push(formatPart.toString().replace(/\s+/gi, ''));
                        });
                    }         
                    return out;
                }
                return null;
            };
            
            Helper.prototype.validateDateTimeFormatStr = function (formatStr) {
                //dd[any_except_alpha]mm[any_except_alpha]yyyy HH[any_except_alpha]MM[any_except_alpha]SS
                //Example: dd/mm/yyyy HH:MM:SS | yy/dd/mm| dd/mm/yyyy SS:MM:HH
                //w+ (lower): extract dd, mm, yyyy
                //W+ (upper): extract symbols
                var pattern = /^(\s)*[\w+]{1,4}(\W+[\w+]{1,4}(\W+[\w+]{1,4}(\s)*)?)?(\s+[\w+]{1,4}(\W+[\w+]{1,4}(\W+[\w+]{1,4}(\s)*)?)?)?$/gi;
                return (typeof formatStr === 'string') ? pattern.test(formatStr.trim()) : false;
            };
            
            Helper.prototype.getFormatTypesAndSymbols = function (formatStr) {
                if (formatStr && typeof formatStr === 'string'){
                    var patternType   = /\w+/gi; //w+ (lower): any words    => extract dd, mm, yyyy
                    var patternSymbol = /\W+/gi; //W+ (upper): no any words => extract symbols

                    var formatTypes   = formatStr.match(patternType);   //extract types: DDDD | DD | YYYY ...
                    var formatSymbols = formatStr.match(patternSymbol); //extract symbols: / | \ | - ....
                    var out    = { types: [], symbols: [] };
                    var errors = [];
                            
                    if (formatTypes){
                        //Get types (alphabet)
                        formatTypes.forEach(function (formatType) {
                            //check whether it exists in the allowed array
                            if (Helper.validateFormatType(formatType.trim())) out.types.push(formatType.trim());
                            else errors.push(formatType.trim());                                           
                        });
                        //Get symbols
                        if (formatSymbols){
                            formatSymbols.forEach(function (formatSymbol) {
                                out.symbols.push(formatSymbol.trim());
                            });
                        }                
                    }            
                    return errors.length === 0 ? out : null;
                }
                else return null;               
            };
            
            Helper.prototype.validateFormatType = function (type){
                var allowed = [
                    'DD', 'dd', 'D'   , 'd',
                    'MM', 'mm', 'M'   , 'm',
                    'YY', 'yy', 'yyyy', 'YYYY',            
                    'HH', 'hh', 'H'   , 'h',
                    'II', 'ii', 'I'   , 'i',
                    'SS', 'ss', 'S'   , 's'
                ];
                return (type && typeof type === 'string') ? (allowed.indexOf(type) !== -1 ? true : false) : false;   
            };

            return new Helper();
        }());

        var AlertMessage = {
            error: function (message) {
                return '<div class="alert alert-danger alert-dismissible fade in">' + 
                       '    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + 
                       '    <strong>Error!</strong> ' + message +  
                       '</div>';
            },
            success: function (message) {
                return '<div class="alert alert-success alert-dismissible fade in">' + 
                       '    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + 
                       '    <strong>Error!</strong> ' + message +  
                       '</div>';
            },
            info: function (message) {
                return '<div class="alert alert-info alert-dismissible fade in">' + 
                       '    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + 
                       '    <strong>Error!</strong> ' + message +  
                       '</div>';
            },
            warning: function (message) {
                return '<div class="alert alert-warning alert-dismissible fade in">' + 
                       '    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + 
                       '    <strong>Error!</strong> ' + message +  
                       '</div>';
            }
        };

        $(function () {
            $('#datepicker').datepicker({
                autoclose: true, 
                todayHighlight: true,
                format: "yyyy-mm-dd"
            });

            var errors = ['promotionName', 'planStartDate', 'amount', 'mileType'];
            /* Validate PromotionName whether it is empty. If error, show the error message */
            $('input[name="promotionName"]').on('change', function (e) {
                e.preventDefault();

                var inputThis = $(this);
                var promotionName = inputThis.val();
                if (!promotionName) {
                    if (errors.indexOf('promotionName') === -1) errors.push('promotionName');                   
                    // remove the previous error message if exists
                    inputThis.prev('.alert.alert-danger').remove();
                    // show thw error message
                    $(AlertMessage.error('Please enter a promotion name.')).insertBefore(inputThis);
                } else {
                    Helper.removeElement('promotionName', errors);
                    // remove the previous error message if exists
                    inputThis.prev('.alert.alert-danger').remove();
                }
                // enable/disable Save button
                checkStatusBtnSave();
            });

            /* Validate Amount whether it is empty or invalid format. If error, show the error message */
            $('input[name="planStartDate"]').on('change', function (e) {
                e.preventDefault();

                var inputThis = $(this);
                var startDate = inputThis.val();
                if (!startDate || !Helper.date_format(startDate, 'yyyy-mm-dd')) { 
                    if (errors.indexOf('planStartDate') === -1) errors.push('planStartDate');
                    // remove the previous error message if exists
                    inputThis.prev('.alert.alert-danger').remove();
                    // show thw error message                 
                    $(AlertMessage.error('Please enter a valid date (yyyy-mm-dd).')).insertBefore(inputThis);
                } else {
                    Helper.removeElement('planStartDate', errors);
                    // remove the previous error message if exists
                    inputThis.prev('.alert.alert-danger').remove();                    
                }
                // enable/disable Save button
                checkStatusBtnSave();
            });

            /* Validate Amount whether it is empty or invalid format. If error, show the error message */
            $('input[name="amount"]').on('change', function (e) {
                e.preventDefault();

                var inputThis = $(this);
                var amount = inputThis.val();          
                if (!amount || !Helper.isNumeric(amount)) { 
                    if (errors.indexOf('amount') === -1) errors.push('amount');
                    // remove the previous error message if exists
                    inputThis.prev('.alert.alert-danger').remove();
                    // show thw error message                 
                    $(AlertMessage.error('Please enter a valid amount (positive number).')).insertBefore(inputThis);
                } else {
                    Helper.removeElement('amount', errors);
                    // remove the previous error message if exists
                    inputThis.prev('.alert.alert-danger').remove();                    
                }
                // enable/disable Save button
                checkStatusBtnSave();
            });

            /* Validate MileType whether it is empty. If error, show the error message */
            $('select[name="mileType"]').on('change', function (e) {
                e.preventDefault();

                var inputThis = $(this);
                var type = inputThis.val();          
                if (!type || !Helper.isNumeric(type)) { 
                    if (errors.indexOf('mileType') === -1) errors.push('mileType');
                    // remove the previous error message if exists
                    inputThis.prev('.alert.alert-danger').remove();
                    // show thw error message                 
                    $(AlertMessage.error('Please pick a Mile Type up.')).insertBefore(inputThis);
                } else {
                    Helper.removeElement('mileType', errors);
                    // remove the previous error message if exists
                    inputThis.prev('.alert.alert-danger').remove();
                }
                // enable/disable Save button
                checkStatusBtnSave();
            });
            
            // enable/disable Save button
            function checkStatusBtnSave() { 
                console.log(errors);   
                if (errors.length === 0) $('.btnSave').removeAttr('disabled');
                else $('.btnSave').attr('disabled', 'disabled');    
            }
        });        
    </script>
</body>
</html>