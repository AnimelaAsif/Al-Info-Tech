function doPost(e) {
  // Open the spreadsheet by its URL
  var spreadsheet = SpreadsheetApp.openByUrl("https://docs.google.com/spreadsheets/d/1GyrBMAYonvPg41DIKd0J9-oLfjR9ZYaYaNp450joYi8/edit#gid=0");
  var sheet = spreadsheet.getActiveSheet();

  // Get the last row with data in the sheet and add 1 to get the row number for the new entry
  var newRow = sheet.getLastRow() + 1;

  // Set the values from the form fields to specific cells in the new row
  sheet.getRange('A' + newRow).setValue(e.parameter.name);
  sheet.getRange('B' + newRow).setValue(e.parameter.email);
  sheet.getRange('C' + newRow).setValue(e.parameter.phone);
  sheet.getRange('D' + newRow).setValue(e.parameter.destination);
  sheet.getRange('E' + newRow).setValue(e.parameter.departure);
  sheet.getRange('F' + newRow).setValue(e.parameter.return);
  sheet.getRange('G' + newRow).setValue(e.parameter.adults);
  sheet.getRange('H' + newRow).setValue(e.parameter.children);
  sheet.getRange('I' + newRow).setValue(e.parameter.message);
  
  return ContentService.createTextOutput('Success').setMimeType(ContentService.MimeType.TEXT);
}