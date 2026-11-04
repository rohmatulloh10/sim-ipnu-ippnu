
import { Link, usePage } from '@inertiajs/react';
import type { PageProps } from '@inertiajs/core';

import {
    BookOpen,
    FolderGit2,
    LayoutDashboard,
    CalendarClock,
    Building2,
    Users,
    Mail,
    Banknote,
    ClipboardList,
    CalendarDays,
    Network,
    History,
} from 'lucide-react';

import AppLogo from '@/components/app-logo';
import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';

import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';

import { dashboard } from '@/routes';
import type { NavItem } from '@/types';

// ========================================
// INTERFACE DATA PENGGUNA
// ========================================

interface AuthUser {
    id: number;
    username: string;
    email: string;
    role_id: number;
    role: string | null;
}

interface SharedData extends PageProps {
    auth: {
        user: AuthUser | null;
    };
    name: string;
    sidebarOpen: boolean;
}

// ========================================
// INTERFACE MENU DAN ROLE
// ========================================

type RoleNavItem = NavItem & {
    roles?: string[];
};

// ========================================
// DAFTAR ROLE
// ========================================

const allRoles = [
    'superadmin',
    'bph',
    'sekretaris',
    'bendahara',
    'dept_head',
    'admin_desa',
];

// ========================================
// MENU UTAMA
// ========================================

const mainNavItems: RoleNavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutDashboard,
        roles: allRoles,
    },

    {
        title: 'Masa Khidmat',
        icon: CalendarClock,
        roles: ['superadmin', 'bph', 'sekretaris', 'bendahara'],
        subitems: [
            {
                subtitle: 'Dashboard',
                subhref: '/masa-khidmat',
                roles: ['superadmin', 'bph', 'sekretaris', 'bendahara'],
            },
            {
                subtitle: 'Master',
                subhref: '/masa-khidmat/master',
                roles: ['superadmin', 'bph', 'sekretaris'],
            },
        ],
    },

    {
        title: 'Departement',
        icon: Building2,
        roles: ['superadmin', 'bph', 'sekretaris', 'dept_head'],
        subitems: [
            {
                subtitle: 'Dashboard',
                subhref: '/departement',
                roles: ['superadmin', 'bph', 'sekretaris', 'dept_head'],
            },
            {
                subtitle: 'Master',
                subhref: '/departement/master',
                roles: ['superadmin', 'bph', 'dept_head'],
            },
        ],
    },

    {
        title: 'Anggota',
        icon: Users,
        roles: ['superadmin', 'bph', 'sekretaris', 'dept_head', 'admin_desa'],
        subitems: [
            {
                subtitle: 'Dashboard',
                subhref: '/anggota',
                roles: ['superadmin', 'bph', 'sekretaris', 'dept_head', 'admin_desa'],
            },
            {
                subtitle: 'Master',
                subhref: '/anggota/master',
                roles: ['superadmin', 'bph', 'sekretaris', 'dept_head', 'admin_desa'],
            },
        ],
    },

    {
        title: 'Surat',
        icon: Mail,
        roles: ['superadmin', 'bph', 'sekretaris', 'admin_desa'],
        subitems: [
            {
                subtitle: 'Dashboard',
                subhref: '/surat',
                roles: ['superadmin', 'bph', 'sekretaris', 'admin_desa'],
            },
            {
                subtitle: 'Master',
                subhref: '/surat/master',
                roles: ['superadmin', 'bph', 'sekretaris'],
            },
        ],
    },

    {
        title: 'Keuangan',
        icon: Banknote,
        roles: ['superadmin', 'bph', 'bendahara'],
        subitems: [
            {
                subtitle: 'Dashboard',
                subhref: '/keuangan',
                roles: ['superadmin', 'bph', 'bendahara'],
            },
            {
                subtitle: 'Master',
                subhref: '/keuangan/master',
                roles: ['superadmin', 'bendahara'],
            },
        ],
    },

    {
        title: 'Program Kerja',
        icon: ClipboardList,
        roles: ['superadmin', 'bph', 'sekretaris', 'dept_head'],
        subitems: [
            {
                subtitle: 'Dashboard',
                subhref: '/program-kerja',
                roles: ['superadmin', 'bph', 'sekretaris', 'dept_head'],
            },
            {
                subtitle: 'Master',
                subhref: '/program-kerja/master',
                roles: ['superadmin', 'bph', 'dept_head'],
            },
        ],
    },

    {
        title: 'Kegiatan',
        icon: CalendarDays,
        roles: allRoles,
        subitems: [
            {
                subtitle: 'Dashboard',
                subhref: '/kegiatan',
                roles: allRoles,
            },
            {
                subtitle: 'Master',
                subhref: '/kegiatan/master',
                roles: ['superadmin', 'bph', 'sekretaris', 'dept_head', 'admin_desa'],
            },
        ],
    },

    {
        title: 'Ranting & PK',
        icon: Network,
        roles: ['superadmin', 'bph', 'sekretaris', 'admin_desa'],
        subitems: [
            {
                subtitle: 'Dashboard',
                subhref: '/ranting-pk',
                roles: ['superadmin', 'bph', 'sekretaris', 'admin_desa'],
            },
            {
                subtitle: 'Master',
                subhref: '/ranting-pk/master',
                roles: ['superadmin', 'bph', 'admin_desa'],
            },
        ],
    },

    {
        title: 'Log History',
        href: '/log-history',
        icon: History,
        roles: ['superadmin'],
    },
];

// ========================================
// MENU FOOTER
// ========================================

const footerNavItems: NavItem[] = [
    // {
    //     title: 'Repository',
    //     href: 'https://github.com/laravel/react-starter-kit',
    //     icon: FolderGit2,
    // },
    // {
    //     title: 'Documentation',
    //     href: 'https://laravel.com/docs/starter-kits#react',
    //     icon: BookOpen,
    // },
];

// ========================================
// KOMPONEN APP SIDEBAR
// ========================================

export function AppSidebar() {
    // console.log('APP SIDEBAR RENDERED');
    const page = usePage<SharedData>();

    // console.log('INERTIA PROPS:', page.props);
    // console.log('AUTH DATA:', page.props.auth);
    // console.log('USER DATA:', page.props.auth?.user);
    // console.log('USER ROLE:', page.props.auth?.user?.role);


    // Role pengguna yang sedang login
    const { auth } = page.props;
    const userRole = auth?.user?.role ?? '';

    // Filter menu berdasarkan role
    const filteredNavItems: NavItem[] = mainNavItems
        .filter((item) => {
            return !item.roles || item.roles.includes(userRole);
        })
        .map((item) => {
            if (!item.subitems) {
                return item;
            }

            const filteredSubitems = item.subitems.filter((subitem) => {
                return (
                    !subitem.roles ||
                    subitem.roles.includes(userRole)
                );
            });

            return {
                ...item,
                subitems: filteredSubitems,
            };
        })
        .filter((item) => {
            return !item.subitems || item.subitems.length > 0;
        });

    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href={dashboard()} prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={filteredNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter
                    items={footerNavItems}
                    className="mt-auto"
                />

                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
