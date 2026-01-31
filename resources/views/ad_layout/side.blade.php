{{-- Sidebar: fixed on desktop (lg+), drawer on mobile --}}
<aside class="fixed left-0 top-16 bottom-0 z-30 w-64 max-w-[85vw] lg:max-w-none transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-out bg-white shadow-admin-lg border-r border-admin-border"
       x-data="{ open: false }"
       @toggle-sidebar.window="open = !open"
       :class="{ 'translate-x-0': open }"
       @keydown.escape.window="open = false"
       id="sidebar">
    {{-- Mobile backdrop --}}
    <div class="fixed inset-0 bg-black/50 z-0 lg:hidden"
         x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"
         x-cloak
         style="display: none;"></div>

    {{-- Sidebar panel --}}
    <div class="relative z-10 h-full flex flex-col bg-white">
        <div class="flex items-center justify-between p-4 border-b border-admin-border lg:hidden flex-shrink-0">
            <a href="{{ route('admin.dashboard') }}" class="text-admin-primary font-ubuntu text-lg font-semibold" @click="open = false">BAN-PDM JATIM</a>
            <button type="button" class="p-2 rounded-lg text-admin-text-secondary hover:bg-admin-light hover:text-admin-primary transition-colors" @click="open = false" aria-label="Close menu">
                <i class="fas fa-times admin-icon-lg"></i>
            </button>
        </div>

        <div class="p-4 pt-6 flex-1 overflow-y-auto">
            <nav class="space-y-1" @click="if ($event.target.closest('a')) open = false">
                <div class="mb-6">
                    <p class="px-3 text-xs font-semibold text-admin-text-secondary uppercase tracking-wider mb-3">Main Menu</p>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-admin-text-primary hover:bg-admin-light hover:text-admin-primary transition-all group">
                        <i class="fas fa-tachometer-alt admin-icon w-5 text-admin-text-secondary group-hover:text-admin-primary transition-colors"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </div>
                <div class="mb-6">
                    <p class="px-3 text-xs font-semibold text-admin-text-secondary uppercase tracking-wider mb-3">Content</p>
                    <a href="{{ route('admin.home.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-admin-text-primary hover:bg-admin-light hover:text-admin-primary transition-all group">
                        <i class="fas fa-home admin-icon w-5 text-admin-text-secondary group-hover:text-admin-primary transition-colors"></i>
                        <span class="font-medium">Home Page</span>
                    </a>
                    <a href="{{ route('admin.berita.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-admin-text-primary hover:bg-admin-light hover:text-admin-primary transition-all group">
                        <i class="fas fa-newspaper admin-icon w-5 text-admin-text-secondary group-hover:text-admin-primary transition-colors"></i>
                        <span class="font-medium">Berita</span>
                    </a>
                    <a href="{{ route('admin.staff.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-admin-text-primary hover:bg-admin-light hover:text-admin-primary transition-all group">
                        <i class="fas fa-users admin-icon w-5 text-admin-text-secondary group-hover:text-admin-primary transition-colors"></i>
                        <span class="font-medium">Staff Management</span>
                    </a>
                </div>
                @if(auth()->user()->hasRole('admin'))
                <div class="mb-6">
                    <p class="px-3 text-xs font-semibold text-admin-text-secondary uppercase tracking-wider mb-3">Administration</p>
                    <div x-data="{ open: false }" class="mb-1">
                        <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-lg text-admin-text-primary hover:bg-admin-light hover:text-admin-primary transition-all group">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-users-cog admin-icon w-5 text-admin-text-secondary group-hover:text-admin-primary transition-colors"></i>
                                <span class="font-medium">Role & User Management</span>
                            </div>
                            <i class="fas fa-chevron-down admin-icon-sm text-admin-text-secondary transition-transform" :class="{'rotate-180': open}"></i>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="ml-4 mt-1 space-y-1 border-l-2 border-admin-light pl-4">
                            <a href="{{ route('admin.role-management.index') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg text-sm text-admin-text-primary hover:bg-admin-light hover:text-admin-primary transition-all group">
                                <i class="fas fa-th-large admin-icon w-4 text-admin-text-secondary group-hover:text-admin-primary transition-colors"></i>
                                <span>Overview</span>
                            </a>
                            <a href="{{ route('admin.role-management.users') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg text-sm text-admin-text-primary hover:bg-admin-light hover:text-admin-primary transition-all group">
                                <i class="fas fa-user admin-icon w-4 text-admin-text-secondary group-hover:text-admin-primary transition-colors"></i>
                                <span>Users</span>
                            </a>
                            <a href="{{ route('admin.role-management.roles') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg text-sm text-admin-text-primary hover:bg-admin-light hover:text-admin-primary transition-all group">
                                <i class="fas fa-user-shield admin-icon w-4 text-admin-text-secondary group-hover:text-admin-primary transition-colors"></i>
                                <span>Roles</span>
                            </a>
                            <a href="{{ route('admin.role-management.permissions') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg text-sm text-admin-text-primary hover:bg-admin-light hover:text-admin-primary transition-all group">
                                <i class="fas fa-key admin-icon w-4 text-admin-text-secondary group-hover:text-admin-primary transition-colors"></i>
                                <span>Permissions</span>
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('admin.config.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-admin-text-primary hover:bg-admin-light hover:text-admin-primary transition-all group">
                        <i class="fas fa-cog admin-icon w-5 text-admin-text-secondary group-hover:text-admin-primary transition-colors"></i>
                        <span class="font-medium">Configuration</span>
                    </a>
                </div>
                @endif
            </nav>
        </div>
    </div>
</aside>
