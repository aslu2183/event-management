import Api from './index';

export default {
    getUser(){
        return Api().get('/user')
    },
    signIn(form){
        return Api().post('/login',form)
    },
    signOut(){
        return Api().get('/logout')
    }

}