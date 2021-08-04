var input = $("#client_tel")

input.on('keyup', function () {
    console.log('toto');
    n = input.val().replace(/\s/g, '')
    n_formated = n.split(/(\d{2})/).join(' ').trim()
  input.val(n_formated)
})