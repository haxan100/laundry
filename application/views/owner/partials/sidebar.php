<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li class="<?= ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'index') ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('owner') ?>" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title">Management</li>

                <li class="<?= ($this->uri->segment(2) == 'master_role') ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('owner/master_role') ?>" class="waves-effect">
                        <i class="ti-settings"></i>
                        <span>Master Role</span>
                    </a>
                </li>

                <li class="<?= ($this->uri->segment(2) == 'master_owner') ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('owner/master_owner') ?>" class="waves-effect">
                        <i class="mdi mdi-crown"></i>
                        <span>Master Owner</span>
                    </a>
                </li>

                <li class="<?= ($this->uri->segment(2) == 'master_admin') ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('owner/master_admin') ?>" class="waves-effect">
                        <i class="ti-user"></i>
                        <span>Master Admin</span>
                    </a>
                </li>

                <li class="<?= ($this->uri->segment(2) == 'master_customer') ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('owner/master_customer') ?>" class="waves-effect">
                        <i class="ti-id-badge"></i>
                        <span>Master Customer</span>
                    </a>
                </li>

                <li class="menu-title">Settings</li>

                <li class="<?= ($this->uri->segment(2) == 'setting_discount') ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('owner/setting_discount') ?>" class="waves-effect">
                        <i class="mdi mdi-percent"></i>
                        <span>Setting Diskon Tier</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>