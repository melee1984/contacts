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

                <!-- Option to Add --> 
                <div class="form-upload-card" v-if="addAction">
                 <div class="card-body">
                    <form class="form">
                  
                      <div class="form-group mb-2">
                        <label for="name" class="sr-only">Name</label>
                        <input type="text"  class="form-control" name="name" value="" placeholder="Name" v-model="fields.name">
                      </div>

                      <div class="form-group mb-2">
                        <label for="email" class="sr-only">Email Address</label>
                        <input type="text"  class="form-control" name="email" value="" placeholder="Email Address" v-model="fields.email">
                      </div>

                      <div class="form-group mb-2">
                        <label for="phone" class="sr-only">Phone</label>
                        <input type="text"  class="form-control" name="phone" value="" placeholder="Phone" v-model="fields.phone">
                      </div>

                       <div class="form-group mb-2">
                        <label for="country" class="sr-only">Country</label>
                        <input type="text"  class="form-control" name="country" value="" placeholder="Country" v-model="fields.country">
                      </div>


                       <div class="form-group mb-2">
                        <label for="city" class="sr-only">City</label>
                        <input type="text"  class="form-control" name="phone" value="" placeholder="City" v-model="fields.city">
                      </div>


                       <div class="form-group mb-2">
                        <label for="state" class="sr-only">State</label>
                        <input type="text"  class="form-control" name="state" value="" placeholder="State" v-model="fields.state">
                      </div>


                       <div class="form-group mb-2">
                        <label for="postal_code" class="sr-only">Postal Code</label>
                        <input type="text"  class="form-control" name="postal_code" value="" placeholder="Portal Code" v-model="fields.postal_code">
                      </div>

                        <br/>

                      <button type="button" class="btn btn-primary sr-2" v-on:click="submitRecord()">Add</button>&nbsp;
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
                                                <a href="javascript:void(0)" >Edit</a> | 
                                                <a href="javascript:void(0)" v-on:click="deleteRecord()">Delete</a>
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
                
                addAction: false,
                editAction: false,
                mPhonebook: false,
                loading: true,
                errors: {},
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
                var self = this;
                self.addAction = false;
            },
            submitRecord: function() {
                var self = this;
                
                self.errors = {};
                if (this.validateFields(self.fields)) {
                    axios.post('/api/request/submit', self.fields).then(response => {
                    
                        self.data = response.data.record;
                        self.addAction = false;

                     }).catch(error => {
                        if (error.response.status === 422) {
                          self.errors = error.response.data.errors || {};
                        }
                        else {
                        }
                     });
                }
                else {
                    // message should be here 
                }
                
            },
            deleteRecord: function () { 

                // alert('Delete is not yet available');

                
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
                
                // should loop in here 
                //

                return true;
            },

           
           
           
        }
    }

</script>
