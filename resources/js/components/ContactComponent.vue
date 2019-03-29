<template>
    <div>

    <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            Phonebook
                        </div>

                        <div class="col-md-9 text-right">
                            <a v-on:click="addPhone()" href="javascript:void(0)">Add Phonebook</a> | 
                            <a v-on:click="actionPhonebook(1)" href="javascript:void(0)" v-if="!mPhonebook" >Manage Phonebook</a>
                            <a v-on:click="actionPhonebook(0)" href="javascript:void(0)"  v-if="mPhonebook" >Done</a>
                        </div>
                    </div>
                </div>

                <div v-if="errors.length > 0">
                  <ul class="alert alert-danger">
                      <li v-for="(value, key, index) in errors">{{ value }}</li>
                  </ul>
              </div>


                <!-- Option to Add --> 
                <div class="form-upload-card" v-if="addAction">
                 <div class="card-body">
                    <form class="form">
                        
                      <div class="form-group mb-2">
                        <label for="name" class="sr-only">Name</label>
                        <input type="text"  class="form-control" name="name" value="" placeholder="Name" v-model="fields.name">
                        <span v-if="errors.name" :class="['text-danger']">@{{ errors.name[0] }}</span>

                      </div>

                      <div class="form-group mb-2">
                        <label for="email" class="sr-only">Email Address</label>
                        <input type="text"  class="form-control" name="email" value="" placeholder="Email Address" v-model="fields.email">
                        <span v-if="errors.email" :class="['text-danger']">@{{ errors.email[0] }}</span>
                      </div>

                      <div class="form-group mb-2">
                        <label for="phone" class="sr-only">Phone</label>
                        <input type="text" class="form-control" name="phone" value="" placeholder="Phone" v-model="fields.phone">
                        <span v-if="errors.phone" :class="['text-danger']">@{{ errors.phone[0] }}</span>

                      </div>

                       <div class="form-group mb-2">
                        <label for="country" class="sr-only">Country</label>
                        <input type="text"  class="form-control" name="country" value="" placeholder="Country" v-model="fields.country">
                        <span v-if="errors.country" :class="['text-danger']">@{{ errors.country[0] }}</span>
                      </div>


                       <div class="form-group mb-2">
                        <label for="city" class="sr-only">City</label>
                        <input type="text"  class="form-control" name="city" value="" placeholder="City" v-model="fields.city">
                        <span v-if="errors.city" :class="['text-danger']">@{{ errors.city[0] }}</span>
                      </div>


                       <div class="form-group mb-2">
                        <label for="state" class="sr-only">State</label>
                        <input type="text"  class="form-control" name="state" value="" placeholder="State" v-model="fields.state">
                        <span v-if="errors.state" :class="['text-danger']">@{{ errors.state[0] }}</span>
                      </div>


                       <div class="form-group mb-2">
                        <label for="postal_code" class="sr-only">Postal Code</label>
                        <input type="text"  class="form-control" name="postal_code" value="" placeholder="Portal Code" v-model="fields.postal_code">
                        <span v-if="errors.postal_code" :class="['text-danger']">@{{ errors.postal_code[0] }}</span>
                      </div>


                        <br/>

                      <button type="button" class="btn btn-primary sr-2" v-on:click="submitRecord()">Add</button>&nbsp;
                      <button type="button" class="btn btn-secondary sr-2" v-on:click="closeForm()">Cancel</button>
                    </form>
                    </div>
                </div>

                <!-- Option to Edit --> 
                <div class="form-upload-card" v-if="editAction">
                 <div class="card-body">
                    <form class="form">
                        
                    <input type="hidden"  class="form-control" name="id" v-model="fillfields.id">

                      <div class="form-group mb-2">
                        <label for="name" class="sr-only">Name</label>
                        <input type="text"  class="form-control" name="name" placeholder="Name" v-model="fillfields.name">
                      </div>

                      <div class="form-group mb-2">
                        <label for="email" class="sr-only">Email Address</label>
                        <input type="text"  class="form-control" name="email" placeholder="Email Address" v-model="fillfields.email">
                      </div>

                      <div class="form-group mb-2">
                        <label for="phone" class="sr-only">Phone</label>
                        <input type="text"  class="form-control" name="phone" placeholder="Phone" v-model="fillfields.phone">
                      </div>

                       <div class="form-group mb-2">
                        <label for="country" class="sr-only">Country</label>
                        <input type="text"  class="form-control" name="country" placeholder="Country" v-model="fillfields.country">
                      </div>


                       <div class="form-group mb-2">
                        <label for="city" class="sr-only">City</label>
                        <input type="text"  class="form-control" name="phone" placeholder="City" v-model="fillfields.city">
                      </div>


                       <div class="form-group mb-2">
                        <label for="state" class="sr-only">State</label>
                        <input type="text"  class="form-control" name="state" placeholder="State" v-model="fillfields.state">
                      </div>


                       <div class="form-group mb-2">
                        <label for="postal_code" class="sr-only">Postal Code</label>
                        <input type="text"  class="form-control" name="postal_code" placeholder="Portal Code" v-model="fillfields.postal_code">
                      </div>

                        <br/>

                      <button type="button" class="btn btn-primary sr-2" v-on:click="updateRecord()">Update</button>&nbsp;
                      <button type="button" class="btn btn-secondary sr-2" v-on:click="closeForm()">Cancel</button>
                    </form>
                    </div>
                </div>



                <!-- Option to Display --> 
                <div class="card-body" v-if="!addAction">
                    <div class="row" >
                        <div class="col-md-12">
                            
                                <table width="100%" class="table table-bordered table-hovered">
                                   <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Country</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Zip Code</th>
                                            <th align="center" v-if="mPhonebook">
                                                &nbsp;
                                            </th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <tr  v-for="list in data">
                                            <td>{{ list.name }}</td>
                                            <td>{{ list.email }}</td>
                                            <td>{{ list.phone }}</td>
                                            <td>{{ list.country }}</td>
                                            <td>{{ list.city }}</td>
                                            <td>{{ list.state }}</td>
                                            <td>{{ list.postal_code }}</td>
                                            <td v-if="mPhonebook"> 
                                                <a href="javascript:void(0)" v-on:click="editRecord(list)" >Edit</a> | 
                                                <a href="javascript:void(0)" v-on:click="deleteRecord(list)" >Delete</a>
                                            </td>
                                        </tr>
                                   </tbody>
                                </table>
                              

                            </div>
                        </div>
                    </div>


                </div>

    </div>

    </div>
</template>
    

<script>

   export default {
        data() {
                
            return {
                fields: {
                   
                    name: '',
                    email: '',
                    phone: '',
                    country: '',
                    city: '',
                    state: '',
                    postal_code: '',
                },
                fillfields: {
                    id: '',
                    name: '',
                    email: '',
                    phone: '',
                    country: '',
                    city: '',
                    state: '',
                    postal_code: '',
                },
                addAction: false,
                editAction: false,
                mPhonebook: false,
                displayMessage: '',
                loading: true,
                errors: [],
                data: [],

            }
        },
        created() {
            this.fetchRecord();
        },
        methods: {
            fetchRecord: function() {
                var self = this;

                axios.get('/api/request')
                    .then(function (response) {
                        self.data = response.data.record;
                        self.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            actionPhonebook: function(action) {

                if (action) {
                    this.mPhonebook = true;
                }
                else {

                    this.mPhonebook = false;
                }
            },

            addPhone: function () { 
                this.addAction = true;
            },
            closeForm: function() {
                
                this.addAction = false;
                this.editAction = false;

            },
            submitRecord: function() {
                
                this.errors = [];

                if (this.validateFields(this.fields)) {
                    axios.post('/api/request/submit', this.fields).then(response => {
                    
                        this.data = response.data.record;
                        this.addAction = false;
                       
                     }).catch(error => {
                        if (error.response.status === 422) {
                          this.errors = error.response.data.errors;
                        }
                        else {
                        }
                     });
                }
                else {

                }
                
            },
            updateRecord: function() {
                
                this.errors = {};

                if (this.validateFields(this.fillfields)) {
                    axios.post('/api/request/update/submit', this.fillfields).then(response => {
                    
                        this.data = response.data.record;
                        this.editAction = false;

                     }).catch(error => {
                        if (error.response.status === 422) {
                          this.errors = error.response.data.errors || {};
                        }
                        else {
                        }
                     });
                }
                else {
                }
                
            },
            editRecord: function(item) {

                this.fillfields.id = item.id;
                this.fillfields.name = item.name;
                this.fillfields.email = item.email;
                this.fillfields.phone = item.phone;
                this.fillfields.country = item.country;
                this.fillfields.city = item.city;
                this.fillfields.state = item.state;
                this.fillfields.postal_code = item.postal_code;

                this.editAction = true;

            },
            deleteRecord: function (item) { 

                this.errors = {};
                var r = confirm("Are you sure want to delete "+ item.name);

                if (r == true) {

                    axios.post('/api/request/delete/'+item.id).then(response => {
                        
                        this.data = response.data.record;
                        this.addAction = false;

                     }).catch(error => {
                        if (error.response.status === 422) {
                          this.errors = error.response.data.errors || {};
                        }
                        else {
                        }
                     });
                }
            },
            validateFields: function(obj) {

                if (obj.name=="") {
                    alert('Please enter Name.');
                    return false;
                }

                if (obj.email=="") {
                    alert('Please enter Email.');
                    return false;
                }

                 if (obj.phone=="") {
                    alert('Please enter Phone.');
                    return false;
                }
               
                return true;
            },

           
           
           
        }
    }

</script>
