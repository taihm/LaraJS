<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header">
          <template v-if="$route.params.id">
            {{ $t('route.staff_edit') }}
          </template>
          <template v-else>
            {{ $t('route.staff_create') }}
          </template>
        </div>
        <el-form ref="staff" v-loading="loading.form" :model="form" :rules="rules" label-position="top">
        <el-form-item
          data-generator="building_id"
          :label="$t('table.staff.building_id')"
          prop="building_id"
          :error="errors.building_id && errors.building_id[0]"
          >
            <el-select v-model="form.building_id" placeholder="Select building">
              <el-option
                v-for="item in building"
                :key="item.id"
                :label="item.name"
                :value="item.id"
              >
                <span style="float: left">{{ item.name }}</span>
                <span style="float: right; color: #8492a6; font-size: 13px">{{ item.address }}</span>
            </el-option>
          </el-select>
					</el-form-item>
          <el-form-item
          data-generator="user_id"
          :label="$t('table.staff.user_id')"
          prop="user_id"
          :error="errors.user_id && errors.user_id[0]"
          >
            <el-select v-model="form.user_id" placeholder="Select user">
              <el-option
                v-for="item in users"
                :key="item.id"
                :label="item.name"
                :value="item.id"
              >
              </el-option>
            </el-select>
					</el-form-item>
          <el-form-item
          data-generator="staff_position_id"
          :label="$t('table.staff.staff_position_id')"
          prop="staff_position_id"
          :error="errors.staff_position_id && errors.staff_position_id[0]"
          >
            <el-select v-model="form.staff_position_id" placeholder="Select position">
              <el-option
                v-for="item in position"
                :key="item.id"
                :label="item.name"
                :value="item.id"
              >
              </el-option>
            </el-select>
					</el-form-item>
          <el-form-item
          data-generator="status"
          :label="$t('table.staff.status')"
          prop="status"
          :error="errors.status && errors.status[0]"
          >
            <el-select v-model="form.status" placeholder="Select status">
              <el-option
                v-for="item in statusOptions"
                :key="item.value"
                :label="item.label"
                :value="item.value"
              >
              </el-option>
            </el-select>
					</el-form-item>
          <!--{{$FROM_ITEM_NOT_DELETE_THIS_LINE$}}-->
          <el-form-item class="tw-flex tw-justify-end">
            <router-link v-slot="{ href, navigate }" :to="{ name: 'Staff' }" custom>
              <a :href="href" class="el-button el-button--info is-plain" @click="navigate">{{ $t('button.cancel') }}</a>
            </router-link>
            <template v-if="$route.params.id">
              <el-button
                :loading="loading.button"
                type="primary"
                icon="el-icon-edit"
                @click="() => update('staff')"
              >
                {{ $t('button.update') }}
              </el-button>
            </template>
            <template v-else>
              <el-button
                :loading="loading.button"
                type="success"
                icon="el-icon-plus"
                @click="() => store('staff')"
              >
                {{ $t('button.create') }}
              </el-button>
            </template>
          </el-form-item>
        </el-form>
      </el-card>
    </el-col>
  </el-row>
</template>

<script>
import GlobalForm from '@/plugins/mixins/global-form';
import StaffResource from '@/api/v1/staff';
// {{$IMPORT_COMPONENT_NOT_DELETE_THIS_LINE$}}

const staffResource = new StaffResource();

export default {
  components: {
    // {{$IMPORT_COMPONENT_NAME_NOT_DELETE_THIS_LINE$}}
  },
  mixins: [GlobalForm],
  data() {
    return {
      form: {
        id: '',
        building_id: '',
        user_id: '',
        staff_position_id: '',
        status: '',
      }, // {{$$}}
      building: [
        {
        id: 1,
        name: 'tower A',
        address: '123 abc',
        status: 1,
        },
        {
          id: 2,
          name: 'tower B',
          address: '456 ggg',
          status: 1,
        },
      ],
      users: [
        {
          id: 1,
          name: 'user A',
          status: 1,
        },
        {
          id: 2,
          name: 'user B',
          status: 1,
        },
      ],
      position: [
        {
          id: 1,
          name: 'Quan ly',
          description: '',
        },
        {
          id: 2,
          name: 'Nhan vien',
          description: '',
        },
      ],
      statusOptions: [
        {
          value: 1,
          label: 'Active',
        },
        {
          value: 0,
          label: 'Unactive',
        }],
      loading: {
        form: false,
        button: false,
      },
      // {{$DATA_NOT_DELETE_THIS_LINE$}}
    };
  },
  computed: {
    // not rename rules
    rules() {
      return {
        building_id: [
          { required: true, message: this.$t('validation.required', { attribute: this.$t('table.staff.building_id') }), trigger: ['change'] },
        ],
        user_id: [
          { required: true, message: this.$t('validation.required', { attribute: this.$t('table.staff.user_id') }), trigger: ['change'] },
        ],
        staff_position_id: [
          { required: true, message: this.$t('validation.required', { attribute: this.$t('table.staff.staff_position_id') }), trigger: ['change'] },
        ],
        status: [
          { required: true, message: this.$t('validation.required', { attribute: this.$t('table.staff.status') }), trigger: ['change'] },
        ],
        // {{$RULES_NOT_DELETE_THIS_LINE$}}
      };
    },
  },
  async created() {
    try {
      this.loading.form = true;
      const { id } = this.$route.params;
      // {{$CREATED_NOT_DELETE_THIS_LINE$}}
      if (id) {
        const {
          data: { data: staff },
        } = await staffResource.get(id);
        this.form = staff;
      }

      const { data } = await staffResource.getDataCreate();
      this.building = data.data.building;
      this.position = data.data.position;

      this.loading.form = false;
    } catch (e) {
      this.loading.form = false;
    }
  },
  methods: {
    store(staff) {
      this.$refs[staff].validate((valid, errors) => {
        if (this.scrollToError(valid, errors)) {
          return;
        }
        this.$confirm(this.$t('common.popup.create'), {
          confirmButtonText: this.$t('button.create'),
          cancelButtonText: this.$t('button.cancel'),
          type: 'warning',
          center: true,
        }).then(async () => {
          try {
            this.loading.button = true;
            await staffResource.store(this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.create'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'Staff' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
    update(staff) {
      this.$refs[staff].validate((valid, errors) => {
        if (this.scrollToError(valid, errors)) {
          return;
        }
        this.$confirm(this.$t('common.popup.update'), {
          confirmButtonText: this.$t('button.update'),
          cancelButtonText: this.$t('button.cancel'),
          type: 'warning',
          center: true,
        }).then(async () => {
          try {
            this.loading.button = true;
            await staffResource.update(this.$route.params.id, this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.update'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'Staff' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
  },
};
</script>
