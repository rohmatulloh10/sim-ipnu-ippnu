import { Link } from '@inertiajs/react';
import { BookOpen, FolderGit2, LayoutGrid, LayoutDashboard, CalendarClock, Building2, Users, Mail, Banknote, ClipboardList, CalendarDays, Network, History } from 'lucide-react';
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

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutDashboard,
    },
    {
        title: 'Masa Khidmat',
        // href: '/masa-khidmat',
        icon: CalendarClock,
        subitems: [
            {
                subtitle: 'dashboard',
                subhref: '/masa-khidmat',
            },
            {
                subtitle: 'Master',
                subhref: '/masa-khidmat/sub-2',
            },
        ]
    },
    {
        title: 'Departement',
        // href: '/masa-khidmat',
        icon: Building2,
        subitems: [
            {
                subtitle: 'dashboard',
                subhref: '/masa-khidmat',
            },
            {
                subtitle: 'Master',
                subhref: '/masa-khidmat/sub-2',
            },
        ]
    },
    {
        title: 'Anggota',
        // href: '/masa-khidmat',
        icon: Users,
        subitems: [
            {
                subtitle: 'dashboard',
                subhref: '/masa-khidmat',
            },
            {
                subtitle: 'Master',
                subhref: '/masa-khidmat/sub-2',
            },
        ]
    },
    {
        title: 'Surat',
        // href: '/masa-khidmat',
        icon: Mail,
        subitems: [
            {
                subtitle: 'dashboard',
                subhref: '/masa-khidmat',
            },
            {
                subtitle: 'Master',
                subhref: '/masa-khidmat/sub-2',
            },
        ]
    },
    {
        title: 'Keuangan',
        // href: '/masa-khidmat',
        icon: Banknote,
        subitems: [
            {
                subtitle: 'dashboard',
                subhref: '/masa-khidmat',
            },
            {
                subtitle: 'Master',
                subhref: '/masa-khidmat/sub-2',
            },
        ]
    },
    {
        title: 'Program Kerja',
        // href: '/masa-khidmat',
        icon: ClipboardList,
        subitems: [
            {
                subtitle: 'dashboard',
                subhref: '/masa-khidmat',
            },
            {
                subtitle: 'Master',
                subhref: '/masa-khidmat/sub-2',
            },
        ]
    },
    {
        title: 'Kegiatan',
        // href: '/masa-khidmat',
        icon: CalendarDays,
        subitems: [
            {
                subtitle: 'dashboard',
                subhref: '/masa-khidmat',
            },
            {
                subtitle: 'Master',
                subhref: '/masa-khidmat/sub-2',
            },
        ]
    },
    {
        title: 'Ranting & PK',
        // href: '/masa-khidmat',
        icon: Network,
        subitems: [
            {
                subtitle: 'dashboard',
                subhref: '/masa-khidmat',
            },
            {
                subtitle: 'Master',
                subhref: '/masa-khidmat/sub-2',
            },
        ]
    },

    {
        title: 'Log History',
        href: '/log-history',
        icon: History,
    },
];

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

export function AppSidebar() {
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
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
