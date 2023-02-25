async function auth() {
    const data = {
        login: document.getElementById('login').value,
        senha: document.getElementById('senha').value
    }
    loading()
    const res = await axios({
        method: 'POST',
        url: 'auth',
        data
    }).catch(res => { return res })
    
    if (res.status != 200) {
        Swal.fire({
            icon: 'error',
            title: res.response.data.message
        })
        return
    }
    setCookie('usu_token',res.data.token,1)
    Swal.close()
    window.location = '/auth/home'



}