let app = new Vue({
    el: "#app",
    data() {
        return {
            isAddBtn: false,
            isDeleteBtn: false,
            isEditBtn: false,
            lodDel: ``,
            lodEdi: ``,
            lodAdd: ``,
            user: {
                firstName: "",
                lastName: "",
                email: "",
            },
            push: {
                firstName: "",
                lastName: "",
                email: "",
            },
            allUsers: [],
            ErrfirstName: false,
            ErrlastName: false,
            Erremail: false,
            btn: false,
            idUser: 0,
        }
    },
    created() {
        fetch("./php/loadUser.php", { method: "GET" })
            .then(res => res.json())
            .then(res => {
                this.allUsers = res.mes
            })
    },
    methods: {
        empty() {
            this.user.firstName = ""
            this.user.lastName = ""
            this.user.email = ""
        },
        del() {
            this.lodDel = ``
            this.isDeleteBtn = false
            this.btn = false
        },
        focusfirstName() {
            if (this.ErrfirstName == false) return
            this.ErrfirstName = false
        },
        focuslastName() {
            if (this.ErrlastName == false) return
            this.ErrlastName = false
        },
        focusemail() {
            if (this.Erremail == false) return
            this.Erremail = false
        },
        nameFirst() {
            if (this.user.firstName.length > 10) return
            this.ErrfirstName = true
        },
        nameLast() {
            if (this.user.lastName.length > 10) return
            this.ErrlastName = true
        },
        email() {
            if (this.user.email.endsWith("@gmail.com")) return
            this.Erremail = true
        },
        sendData() {
            this.nameLast(); this.nameFirst(); this.email();
            if (this.ErrfirstName == true || this.Erremail == true || this.ErrlastName == true) {
                return
            }
            this.lodAdd = `<div class="spinner-border text-primary" role="status"> </div>`
            this.btn = true
            let fd = new FormData()
            fd.append("firstName", this.user.firstName)
            fd.append("lastName", this.user.lastName)
            fd.append("email", this.user.email)
            fetch("./php/addUser.php", { method: "POST", body: fd })
                .then(res => res.json())
                .then(res => {
                    if (res.mes == "add") {
                        this.lodAdd = `<div class="alert alert-success py-2 m-0" role="alert"> Add user is a success </div>`
                        this.btn = false
                        this.empty()
                    } else if (res.mes == "found") {
                        this.lodAdd = `<div class="alert alert-warning py-2 m-0" role="alert"> this user is found </div>`
                        this.empty()
                        this.btn = false
                    } else {
                        this.lodAdd = `<div class="alert alert-danger py-2 m-0" role="alert"> this user is found </div>`
                        this.empty()
                        this.btn = false
                    }
                })
        },
        updateUser() {
            this.lodEdi = `<div class="spinner-border text-success" role="status"> </div>`,
            this.btn = true
            let fd = new FormData()
            fd.append("idUser", this.allUsers[this.idUser]._id)
            fd.append("firstName", this.user.firstName)
            fd.append("lastName", this.user.lastName)
            fd.append("email", this.user.email)
            fetch("./php/updateUser.php", { method: "POST", body: fd })
                .then(res => res.json())
                .then(res => {
                    console.log(res.mes);
                    if (res.mes == "update") {
                        this.lodEdi = `<div class="alert alert-success py-2 m-0" role="alert"> Edit user is a success </div>`
                        this.btn = false
                        this.empty()
                    } else if (res.mes == "found") {
                        this.lodEdi = `<div class="alert alert-warning py-2 m-0" role="alert"> this user is found </div>`
                        this.empty()
                        this.btn = false
                    } else {
                        this.lodEdi = `<div class="alert alert-danger py-2 m-0" role="alert"> this user is found </div>`
                        this.empty()
                        this.btn = false
                    }
                })
        },
        deleteUser(id) {
            this.lodDel = `<div class="spinner-border text-danger" role="status"> </div>`,
            this.btn = true
            let fd = new FormData()
            fd.append("idUser", this.allUsers[id]._id)
            fetch("./php/deleteUser.php", { method: "POST", body: fd })
                .then(res => res.json())
                .then(res => {
                    if (res.mes == "delete") {
                        this.lodDel = `<div class="alert alert-success py-2 m-0" role="alert"> Delete user is a success </div>` 
                    } else if (res.mes == "not found") {
                        this.lodDel = `<div class="alert alert-warning py-2 m-0" role="alert"> This user is not found </div>`
                    } else {
                        this.lodDel = `<div class="alert alert-danger py-2 m-0" role="alert"> Error 500 !!! </div>`
                    }
                })
        },
    },
})