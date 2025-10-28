<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li class="<?= ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'index') ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('admin') ?>" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title">User Management</li>

                <?php if (check_access_sidebar('master_admin')): ?>
                <li class="<?= ($this->uri->segment(2) == 'master_admin') ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('admin/master_admin') ?>" class="waves-effect">
                        <i class="ti-user"></i>
                        <span>Master Admin</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if (check_access_sidebar('master_role')): ?>
                <li class="<?= ($this->uri->segment(2) == 'master_role') ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('admin/master_role') ?>" class="waves-effect">
                        <i class="ti-settings"></i>
                        <span>Master Role</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if (check_access_sidebar('master_log')): ?>
                <li class="<?= ($this->uri->segment(2) == 'master_log') ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('admin/master_log') ?>" class="waves-effect">
                        <i class="ti-clipboard"></i>
                        <span>Log Activity</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if (check_access_sidebar('master_mitra')): ?>
                <li class="<?= ($this->uri->segment(2) == 'master_mitra') ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('admin/master_mitra') ?>" class="waves-effect">
                        <i class="mdi mdi-handshake"></i>
                        <span>Master Mitra</span>
                    </a>
                </li>
                <?php endif; ?>

                <li class="menu-title">Content Management</li>

                <?php if (check_access_sidebar('terms')): ?>
                <li class="<?= ($this->uri->segment(2) == 'syarat_ketentuan') ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('admin/syarat_ketentuan') ?>" class="waves-effect">
                        <i class="mdi mdi-file-document"></i>
                        <span>Syarat & Ketentuan</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if (check_access_sidebar('policy')): ?>
                <li class="<?= ($this->uri->segment(2) == 'kebijakan') ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('admin/kebijakan') ?>" class="waves-effect">
                        <i class="mdi mdi-shield-check"></i>
                        <span>Kebijakan</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if (check_access_sidebar('setting')): ?>
                <li class="<?= ($this->uri->segment(2) == 'setting') ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('admin/setting') ?>" class="waves-effect">
                        <i class="ti-settings"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>