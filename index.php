<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <title>vue</title>
</head>
<style>
    .show {
        display: block !important;
        opacity: 1 !important;
        background-color: #00000054
    }

    .stop-btn {
        pointer-events: none;
    }

    .show-m {
        top: 150px;
    }

    .err-input {
        box-shadow: 0 0 0 0.25rem rgb(225 83 97 / 50%);
        border-color: rgb(225 83 97 / 50%);
    }
</style>

<body style="background-color:#f0f2f4;">
    <div id="app" style="height: 100vh;">
        <div class="container">
            <div class="py-5 d-flex justify-content-between align-items-center">
                <div class="h1 text-capitalize">
                    add user
                </div>
                <div>
                    <button @click="isAddBtn = true" type="button" class="btn btn-primary text-capitalize ">add user</button>
                </div>
            </div>
            <div class="h-100 d-flex justify-content-center ">
                <table class="table rounded overflow-hidden">
                    <thead class="table-dark">
                        <th scope="col"></th>
                        <th scope="col">first name</th>
                        <th scope="col">last name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </thead>
                    <tbody>
                        <tr v-for="(user,index) in allUsers">
                            <td scope="col" class="align-middle">{{user._id}}</td>
                            <td scope="col" class="align-middle">{{user._f_name}}</td>
                            <td scope="col" class="align-middle">{{user._l_name}}</td>
                            <td scope="col" class="align-middle">{{user._email}}</td>
                            <td scope="col"><button @click="isEditBtn = true , idUser = index" type=" button" class="btn btn-secondary"><i class="far fa-edit"></i></button></td>
                            <td scope="col"><button @click="isDeleteBtn = true , idUser = index" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Start form add user -->

            <div class="modal fade" :class="{show:isAddBtn}" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" :class="{'show-m':isAddBtn}" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  text-capitalize text-primary" id="exampleModalLabel">Add User</h5>
                            <button @click="lodAdd = `` , isAddBtn = false" type="button" class="close border-danger text-danger rounded" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">first name:</label>
                                    <input @focus="focusfirstName()" type="text" class="form-control" :class="{'err-input':ErrfirstName}" id="recipient-name" v-model=user.firstName>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">last name:</label>
                                    <input @focus="focuslastName()" type="text" class="form-control" :class="{'err-input':ErrlastName}" id="recipient-name" v-model=user.lastName>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">email:</label>
                                    <input @focus="focusemail()" type="email" class="form-control" :class="{'err-input':Erremail}" v-model=user.email id="recipient-name">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <div v-html="lodAdd">

                            </div>
                            <div>
                                <button @click="lodAdd = `` , isAddBtn = false" type="button" class="btn btn-secondary" data-dismiss="modal">Cansel</button>
                                <button @click="sendData()" type="button" class="btn btn-primary" :disabled=btn :class="{'stop-btn':btn}">Send user</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End form add user -->

            <!-- Start form update user -->

            <div class="modal fade" :class="{show:isEditBtn}" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" :class="{'show-m':isEditBtn}" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  text-capitalize text-success" id="exampleModalLabel">Edit User</h5>
                            <button @click="lodEdi= ``, isEditBtn = false" type="button" class="close border-danger text-danger rounded" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">id user:</label>
                                    <input type="text" disabled class="form-control" id="recipient-name" :value="allUsers[idUser]._id">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">first name:</label>
                                    <input @focus="focusfirstName()" type="text" class="form-control" id="recipient-name" v-model=user.firstName>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">last name:</label>
                                    <input @focus="focuslastName()" type="text" class="form-control" id="recipient-name" v-model=user.lastName>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">email:</label>
                                    <input @focus="focusemail()" type="email" class="form-control" v-model=user.email id="recipient-name">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <div v-html="lodEdi">
                            </div>
                            <div>
                                <button @click="lodEdi = ``, isEditBtn=false" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button @click="updateUser()" type="button" class="btn btn-success" :disabled=btn :class="{'stop-btn':btn}">Upadte user</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End form update user -->

            <!-- start form delete user -->

            <div class="modal fade" :class="{show:isDeleteBtn}" id=" exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role=" document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  text-capitalize text-danger" id="exampleModalLongTitle">delete user</h5>
                            <button @click="del()" type="button" class="close border-danger text-danger rounded" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="m-0">{{ allUsers[idUser]._email}} </p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <div v-html="lodDel">

                            </div>
                            <div>
                                <button @click="del()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button @click="deleteUser(idUser)" type="button" class="btn btn-danger" :disabled=btn :class="{'stop-btn':btn}">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- start form delete user -->
        </div>
    </div>
</body>
<script src="js/app.js"></script>

</html>