$(document).ready(function () {
  $('#birth-date').mask('00/00/0000');
  $('#cep').mask('00000-000');
  $('#cpf').mask('000.000.000-00', { reverse: true });
  $('#phone_with_ddd').mask('(00) 00000-0000');
  $('#somenteNumero').mask('0000000');
});