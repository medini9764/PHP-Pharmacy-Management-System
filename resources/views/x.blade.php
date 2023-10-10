<template>
  <div>
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Customers</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <nuxt-link :to="{ name: `tenant-dashboard`, params: { tenant: this.$auth.user.workspace_slug } }"
                    class="home">Home</nuxt-link>
                </li>
                <li class="breadcrumb-item">
                  <nuxt-link :to="{ name: `tenant-customers`, params: { tenant: this.$auth.user.workspace_slug } }"
                    class="home">Customers</nuxt-link>
                </li>
                <li class="breadcrumb-item active">Edit</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <section>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <form id="addNewCardValidation" class="mt-0 mx-0 mb-3 row w-100" @submit.prevent="updateCustomer()">
                  <!-- Header starts -->
                  <div class="pb-0 card-body invoice-padding-align-left">
                    <div class="mt-0 d-flex justify-content-between flex-md-row flex-column invoice-spacing">
                      <div class="col-md-6">
                        <p class="col-md-6 invoice-title customer-labelhead">
                          Customer Details
                        </p>
                        <div class="d-flex align-items-center customer-input-area justify-content-md-start">
                          <p class="col-md-4 invoice-title customer-label">
                            Name :
                          </p>
                          <div class="col-md-8 input-group input-group-merge invoice-edit-input-group-long">
                            <div class="input-group input-group-merge">
                              <input type="text" class="form-control" v-model="customerEdit.name" placeholder="Enter Name"
                                :class="{ 'is-invalid': validationErrors.name }" name="name"
                                :disabled="$auth.user.user_role == 2" />
                            </div>
                            <div v-if="validationErrors.name" class="invalid-feedback-msg">{{ validationErrors.name }}
                            </div>
                          </div>
                        </div>

                        <div class="d-flex align-items-center customer-input-area justify-content-md-start">
                          <p class="col-md-4 invoice-title customer-label">
                            Address :
                          </p>
                          <div class="col-md-8 input-group input-group-merge invoice-edit-input-group-long">
                            <div class="input-group input-group-merge">
                              <input type="text" class="form-control" v-model="customerEdit.address"
                                placeholder="Enter Address" :class="{ 'is-invalid': validationErrors.address }"
                                name="name" :disabled="$auth.user.user_role == 2" />
                            </div>
                            <div v-if="validationErrors.address" class="invalid-feedback-msg">{{ validationErrors.address
                              }}
                            </div>
                          </div>
                        </div>

                        <div class="d-flex align-items-center customer-input-area justify-content-md-start">
                          <p class="col-md-4 invoice-title customer-label">
                            Contact number :
                          </p>
                          <div class="col-md-8 input-group input-group-merge invoice-edit-input-group-long">
                            <div class="input-group input-group-merge">
                              <input type="text" class="form-control" v-model="customerEdit.contact"
                                placeholder="Enter Contact number" :class="{ 'is-invalid': validationErrors.contact }"
                                name="contact" :disabled="$auth.user.user_role == 2" />
                            </div>
                                           <div v-if="validationErrors.contact" class="invalid-feedback-msg">{{ validationErrors.contact
                              }}
                            </div>
                          </div>
                        </div>

                        <div class="d-flex align-items-center customer-input-area justify-content-md-start">
                          <p class="col-md-4 invoice-title customer-label">
                            Email :
                          </p>
                          <div class="col-md-8 input-group input-group-merge invoice-edit-input-group-long">
                            <div class="input-group input-group-merge">
                                                          <input type="text" class="form-control" v-model="customerEdit.email" placeholder="Enter Email"
                                :class="{ 'is-invalid': validationErrors.email }" name="email"
                                :disabled="$auth.user.user_role == 2" />
                                                            </div>
                            <div v-if="validationErrors.email" class="invalid-feedback-msg">{{ validationErrors.email }}
                            </div>
                          </div>
                        </div>

                        <div class="d-flex align-items-center customer-input-area justify-content-md-start">
                          <p class="col-md-4 invoice-title customer-label">
                            Company :
                          </p>
                          <div class="col-md-8 input-group input-group-merge invoice-edit-input-group-long">
                            <div class="input-group input-group-merge">
                                                          <input type="text" class="form-control" v-model="customerEdit.company"
                                                              placeholder="Enter Company" :class="{ 'is-invalid': validationErrors.company }"
                                name="company" :disabled="$auth.user.user_role == 2" />
                                                            </div>
                            <div v-if="validationErrors.company" class="invalid-feedback-msg">{{ validationErrors.company
                              }}
                            </div>
                          </div>
                        </div>

                        <div class="d-flex align-items-center customer-input-area justify-content-md-start">
                          <p class="col-md-4 invoice-title customer-label">
                            Website :
                          </p>
                          <div class="col-md-8 input-group input-group-merge invoice-edit-input-group-long">
                            <div class="input-group input-group-merge">
                              <input type="text" class="form-control" v-model="customerEdit.website"
                                placeholder="Enter Website" :class="{ 'is-invalid': validationErrors.website }"
                                name="website" :disabled="$auth.user.user_role == 2" />
                            </div>
                                      <div v-if="validationErrors.website" class="invalid-feedback-msg">{{ validationErrors.website
                              }}
                            </div>
                          </div>
                        </div>
                        <div class="d-flex align-items-center customer-input-area justify-content-md-start">
                          <p class="col-md-4 invoice-title customer-label">
                            Credit :
                          </p>
                          <div class="col-md-8 input-group input-group-merge invoice-edit-input-group-long">
                            <input v-number="number" id="edit_credit" v-model="customerEdit.customer_credit"
                          class="form-control" placeholder="Enter Customer Credit "
                          :class="{ 'is-invalid': validationErrors.customer_credit }" name="credit" />
                            <div v-if="validationErrors.customer_credit" class="invalid-feedback-msg">{{ validationErrors.customer_credit }}</div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6 mt-1 invoice-number-date mt-md-0 ">
                        <p class="col-md-6 invoice-title customer-labelhead">
                          Bank Details
                        </p>
                        <div class="d-flex align-items-center customer-input-area justify-content-start">
                          <p class="col-md-4 invoice-title customer-label">Bank Account :</p>
                            <div class="input-group input-group-merge">
                              <input type="text" class="form-control " v-model="customerEdit.account_no"
                                placeholder="Enter Customer Bank Account" :class="{ 'is-invalid': validationErrors.bank_account }"
                                aria-label="Enter Customer Bank Account" :disabled="$auth.user.user_role == 2">
                            </div>
                            <div v-if="validationErrors.bank_account" class="invalid-feedback-msg">
                              {{ validationErrors.bank_account }}</div>
                        </div>

                        <div class="d-flex align-items-center customer-input-area justify-content-start">
                          <p class="col-md-4 invoice-title customer-label">Bank Name :</p>
                                                    <div class="input-group input-group-merge">
                            <input type="text" class="form-control " v-model="customerEdit.bank_name"
                              placeholder="Enter Customer Bank Name" :class="{ 'is-invalid': validationErrors.bank_name }"
                              aria-label="Enter Customer Bank Account" :disabled="$auth.user.user_role == 2">
                          </div>
                                 <div v-if="validationErrors.bank_name" class="invalid-feedback-msg">
                            {{ validationErrors.bank_name }}
                          </div>
                        </div>

                        <div class="d-flex align-items-center customer-input-area justify-content-start">
                          <p class="col-md-4 invoice-title customer-label">Bank Branch :</p>
                          <div class="input-group input-group-merge">
                            <input type="text" class="form-control " v-model="customerEdit.branch_name"
                                                          placeholder="Enter Customer Bank Branch"
                              :class="{ 'is-invalid': validationErrors.bank_branch }"
                              aria-label="Enter Customer Bank Account" :disabled="$auth.user.user_role == 2">
                          </div>
                                   <div v-if="validationErrors.bank_branch" class="invalid-feedback-msg">
                            {{ validationErrors.bank_branch }}</div>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="col-12 mt-4 d-flex justify-content-end btn-mobile">
                      <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light"
                      :disabled="$auth.user.user_role == 2">Submit</button>
                        <nuxt-link class="btn btn-outline-secondary waves-effect"
                      :to="{ name: `tenant-customers`, params: { tenant: this.$auth.user.workspace_slug } }">Cancel</nuxt-link>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
import 'vue-search-select/dist/VueSearchSelect.css'
import { ModelSelect } from 'vue-search-select'

export default {
  name: "customers-edit",
  layout: "dashboard",
  data() {
    return {
      number: {
        decimal: '.',
        thousand: ',',
        prefix: '',
        precision: 2,
        acceptNegative: false,
        //reverseFill:true,
        //min:'1',
        max: '10000000',
      },
      errors: [],
      customerEdit: [],
      customerEdit: {},
    }
  },
  components: {
    ModelSelect
  },
  methods: {
    async getCustomeData() {
      const data = await this.$axios.$get(`/api/customers/${this.$route.params.edit}`)
      this.customerEdit = data.data;
      console.log(this.customerEdit);
    },
    async updateCustomer() {
      this.$nextTick(() => {
        this.$nuxt.$loading.start();
      });
      try {
        await this.$axios.$put(`/api/customers/${this.$route.params.edit}`, this.customerEdit)
          .then((res) => {
            this.$router.push({ name: `tenant-customers`, params: { tenant: this.$auth.user.workspace_slug } })

          })
        this.$nextTick(() => {
          this.$nuxt.$loading.finish();
        })
      } catch (err) {
        this.$nextTick(() => {
          this.$nuxt.$loading.finish();
        });
        if ((err.response.status = 422)) {
          this.errors = err.response.data.errors;

          this.convertValidationError(err);
        }
      };
    }
  },
  async fetch() {
    this.$nextTick(() => {
      this.$nuxt.$loading.start();
    });
    await this.getCustomeData();
    this.$nextTick(() => {
      this.$nuxt.$loading.finish();
    });
  },
  mounted() {
    feather.replace({
      width: 14,
      height: 14,
    });
    this.getCustomeData();
  },
}
</script>

<style lang="scss" scoped>
.text-align {
  padding-left: 0.5%;
}

// .tab-content {
//   padding-left: 1%;
// }

// .card-body-tab {
//   padding-right: 10%;
// }

.shadow-card {
  box-shadow: 0 4px 24px 0 #22292f4d !important;
}

.mobile-txt {
  display: none;
}

.home:hover {
  color: #6ca925;
}

.demo-inline-spacing {
  display: flex;
  flex-wrap: nowrap;
  justify-content: flex-end;
  align-items: stretch;
  align-content: center;
}

.demo-inline-spacing>* {
  margin-right: 1rem;
  margin-top: 0rem;
}

table.dataTable td,
table.dataTable th {
  padding: 0.2rem 0.2rem;
  vertical-align: top;
}

.table th:first-child,
.invoice-add .table td:first-child {
  padding-left: 0.5rem;
}

.handle-area {
  vertical-align: middle !important;
  text-align: center !important;
}

.total-area {
  text-align: right !important;

  span {
    padding-right: 2rem;
  }
}

.customer-input-area {
  margin-bottom: 0.3rem;

  .form-control {
    padding: 0.5rem 0.5rem;
  }
}

.customer-label {
  font-size: 1rem;
  font-weight: bold;
  margin-right: 1rem !important;
}

.customer-labelhead {
  font-size: 1.3rem;
  font-weight: bold;
  margin-right: 1rem !important;
}

.form-control {
  padding: 0.7rem 0.5rem;
  font-size: 1rem;
  font-weight: 300;
  line-height: 1;
}

.form-select {
  padding: 0.5rem 1rem;
  font-size: 1rem;
  font-weight: 300;
  line-height: 1;
}

.plus-btn {
  padding: 0.5rem 1.5rem;
  margin-top: 1.7rem;
  margin-left: 50%;
}

.input-dev-area {
  padding-right: 0.2rem;
}

.nav-tabs .nav-link.active,
.nav-tabs .nav-item.show .nav-link {
  background: linear-gradient(118deg, #0b6e13, rgb(74 145 62 / 70%));
  box-shadow: 0 0 10px 1px rgb(93 219 99 / 70%);
  border-color: #dae1e7 #dae1e7 transparent;
  border-top-left-radius: 0.5rem;
  border-top-right-radius: 0.5rem;
  color: #fff !important;
}

.nav-tabs {
  border-bottom: 2px solid gray;
}

.table-inputs {
  border: none;
}

.table-text-area {
  border: none;
  border-top: 1px solid #d8d6de;
  border-radius: unset;
}

.final-row {
  border-top: 2px solid #c2c1c1cf;
}

.w-fit-content {
  width: fit-content;
}

.quick_nav {
  background: linear-gradient(118deg, #0b6e13, rgb(74 145 62 / 70%));
  box-shadow: 0 0 10px 1px rgb(93 219 99 / 70%);
  border: 1px solid #efefef;
  border-radius: 0rem;
  position: fixed;
  bottom: 0rem;
  padding: 10px;
  left: 0;
  width: 100% !important;
  height: 7%;



  @media (max-width: 1240px) {
    width: 100%;
  }

  @media (max-width: 990px) {
    width: 100%;
  }

  @media (max-width: 768px) {
    width: 100%;
    right: 0;
    left: 0;
    bottom: 0;
    border-radius: 0;
    border-top: 1px solid #a39494;
    .mobile-txt {
    display: inline-block;
  }
  .window-txt {
    display: none;
  }

  }

  .nav-btn {
    padding: 0.4rem 1rem;

  }
}

.message-editor {
  overflow: hidden;
  border-bottom: 1px solid gray;
}

.total-receipt {
  width: 95.4%;
}

.draggable_row {
  background: white;
  border-radius: 1rem;
}

.invoice-edit-input-group {
  width: 200px;
  max-width: 20rem !important;

  .form-control {
    padding: 0.5rem 0.5rem;
  }
}

.invoice-edit-input-group-long {
  width: 20rem;
  max-width: 20rem !important;

  .form-control {
    padding: 0.5rem 0.5rem;
  }
}

.button-outline {
  border-color: #6ca925;
}

.mt-2px {
  margin-top: 2px;
}

.add-customer-btn {
  right: -20px;
  top: 11px;
}

.options-dropdown {
  background: #fff;
  position: absolute;
  top: 32px;
  z-index: 99;
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.option {
  padding: 8px;
  cursor: pointer;
}

.option:hover {
  background-color: #f3f4f5;
}

.table-inputs {
  text-align: right;
}


#productsOptionsDropDown {
  top: 37px;
}

#suppliersOptionsDropDown {
  top: 37px;
}

@media screen and (max-width: 768px) {
  .customer-input-area {
    flex-wrap: wrap;
    width: 20rem;
    max-width: 20rem !important;
  }

  .invoice-title {
    flex-basis: 100%;
    margin-bottom: 5px;
  }

  .input-group-merge {
    flex-basis: 100%;
    margin-bottom: 5px;
  }

  .btn-mobile {
    display: flex !important;
    justify-content: center !important;
  }
}

@media screen and (max-width: 390px) {
  .customer-input-area {
    flex-wrap: wrap;
    width: 15rem;
    max-width: 15rem !important;
  }
}

@media screen and (max-width: 1310px) {
  .customer-input-area {
    flex-wrap: wrap;
    width: 20rem;
    max-width: 20rem !important;
  }

  .invoice-title {
    flex-basis: 100%;
    margin-bottom: 5px;
  }

  .input-group-merge {
    flex-basis: 100%;
    margin-bottom: 5px;
  }
}</style>



