import { type InertiaLinkProps, Link, usePage } from '@inertiajs/react';
// import { dashboard } from '@/routes';
import {
    ArrowLeftRight,
    // BookOpen,
    Briefcase,
    Building2,
    ChevronRight,
    Coins,
    // FolderGit2,
    HandCoins,
    Landmark,
    LayoutGrid,
    type LucideIcon,
    Mail,
    Package,
    Settings,
    Users,
} from 'lucide-react';
import AppLogo from '@/components/app-logo';
import { NavUser } from '@/components/nav-user';
import {
    Collapsible,
    CollapsibleContent,
    CollapsibleTrigger,
} from '@/components/ui/collapsible';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarGroup,
    SidebarGroupLabel,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarMenuSub,
    SidebarMenuSubButton,
    SidebarMenuSubItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';

interface SubMenuItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    permission: string;
}

interface MenuItem {
    title: string;
    icon: LucideIcon;
    href?: NonNullable<InertiaLinkProps['href']>;
    permission?: string;
    items?: SubMenuItem[];
}

interface SharedAuthProps {
    permissions?: string[];
    has_multiple_assignments?: boolean;
    active_assignment?: {
        id: number;
        role?: {
            nama_role: string;
        };
        struktur_organisasi?: {
            nama_unit: string;
            tingkat: string;
        };
    } | null;
}

const navMenuItems: MenuItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
        permission: 'menu.dashboard',
    },
    {
        title: 'Organisasi',
        icon: Building2,
        items: [
            {
                title: 'Struktur Organisasi',
                href: '/organisasi/struktur',
                permission: 'organisasi.struktur.view',
            },
            {
                title: 'Masa Khidmat',
                href: '/organisasi/masa-khidmat',
                permission: 'organisasi.periode.view',
            },
            {
                title: 'Departemen',
                href: '/organisasi/departemen',
                permission: 'organisasi.departemen.view',
            },
        ],
    },
    {
        title: 'Anggota',
        icon: Users,
        items: [
            {
                title: 'Biodata Anggota',
                href: '/anggota',
                permission: 'anggota.biodata.view',
            },
            {
                title: 'Penugasan Pengurus',
                href: '/anggota/penugasan',
                permission: 'anggota.penugasan.view',
            },
        ],
    },
    {
        title: 'Program Kerja',
        icon: Briefcase,
        items: [
            {
                title: 'Kategori Proker',
                href: '/proker/kategori',
                permission: 'proker.kategori.view',
            },
            {
                title: 'Rapat Kerja',
                href: '/proker/raker',
                permission: 'proker.raker.view',
            },
            {
                title: 'Program Kerja',
                href: '/proker/daftar',
                permission: 'proker.daftar.view',
            },
            {
                title: 'Realisasi & LPJ',
                href: '/proker/realisasi',
                permission: 'proker.realisasi.view',
            },
        ],
    },
    {
        title: 'Kesekretariatan',
        icon: Mail,
        items: [
            {
                title: 'Kategori Surat',
                href: '/surat/kategori',
                permission: 'surat.kategori.view',
            },
            {
                title: 'Surat Masuk',
                href: '/surat/masuk',
                permission: 'surat.masuk.view',
            },
            {
                title: 'Surat Keluar',
                href: '/surat/keluar',
                permission: 'surat.keluar.view',
            },
            {
                title: 'Arsip Dokumen',
                href: '/surat/arsip',
                permission: 'surat.arsip.view',
            },
        ],
    },
    {
        title: 'Inventaris',
        icon: Package,
        items: [
            {
                title: 'Kategori Barang',
                href: '/inventaris/kategori',
                permission: 'inventaris.kategori.view',
            },
            {
                title: 'Data Inventaris',
                href: '/inventaris/barang',
                permission: 'inventaris.barang.view',
            },
            {
                title: 'Peminjaman',
                href: '/inventaris/peminjaman',
                permission: 'inventaris.peminjaman.view',
            },
        ],
    },
    {
        title: 'Keuangan',
        icon: Coins,
        items: [
            {
                title: 'Kas & Rekening',
                href: '/keuangan/kas',
                permission: 'keuangan.kas.view',
            },
            {
                title: 'Kategori Keuangan',
                href: '/keuangan/kategori',
                permission: 'keuangan.kategori.view',
            },
            {
                title: 'Transaksi Kas',
                href: '/keuangan/transaksi',
                permission: 'keuangan.transaksi.view',
            },
        ],
    },
    {
        title: 'Iuran Anggota',
        icon: HandCoins,
        items: [
            {
                title: 'Tagihan Iuran',
                href: '/iuran/tagihan',
                permission: 'iuran.tagihan.view',
            },
            {
                title: 'Pembayaran Iuran',
                href: '/iuran/pembayaran',
                permission: 'iuran.pembayaran.view',
            },
        ],
    },
    {
        title: 'Pendanaan Proker',
        icon: Landmark,
        items: [
            {
                title: 'Pihak Pendana',
                href: '/pendanaan/pihak',
                permission: 'pendanaan.pihak.view',
            },
            {
                title: 'Proposal Pendanaan',
                href: '/pendanaan/proposal',
                permission: 'pendanaan.proposal.view',
            },
            {
                title: 'Penerimaan Dana',
                href: '/pendanaan/penerimaan',
                permission: 'pendanaan.penerimaan.view',
            },
        ],
    },
    {
        title: 'Pengaturan & Audit',
        icon: Settings,
        items: [
            {
                title: 'Akun Pengguna',
                href: '/pengaturan/users',
                permission: 'akses.users.view',
            },
            {
                title: 'Penugasan Role',
                href: '/pengaturan/assignment',
                permission: 'akses.assignment.view',
            },
            {
                title: 'Role & Hak Akses',
                href: '/pengaturan/roles',
                permission: 'akses.roles.view',
            },
            {
                title: 'Audit Logs',
                href: '/pengaturan/audit-logs',
                permission: 'audit.logs.view',
            },
        ],
    },
];

// const footerNavItems = [
//     {
//         title: 'Repository',
//         href: 'https://github.com/laravel/react-starter-kit',
//         icon: FolderGit2,
//     },
//     {
//         title: 'Documentation',
//         href: 'https://laravel.com/docs/starter-kits#react',
//         icon: BookOpen,
//     },
// ];

export function AppSidebar() {
    const page = usePage<{ auth: SharedAuthProps }>();
    const { auth } = page.props;
    const currentUrl = page.url;

    const permissions = auth?.permissions ?? [];
    const activeAssignment = auth?.active_assignment;
    const hasMultipleAssignments = auth?.has_multiple_assignments ?? false;

    // Filter menu utama & sub-menu berdasarkan permission role aktif
    const visibleMenus = navMenuItems
        .map((menu) => {
            if (!menu.items) {
                const allowed =
                    !menu.permission || permissions.includes(menu.permission);
                return allowed ? menu : null;
            }

            const allowedSubItems = menu.items.filter((sub) =>
                permissions.includes(sub.permission),
            );

            return allowedSubItems.length > 0
                ? { ...menu, items: allowedSubItems }
                : null;
        })
        .filter((item): item is MenuItem => item !== null);

    const isPathActive = (href?: NonNullable<InertiaLinkProps['href']>) => {
        if (!href) return false;
        const targetUrl = typeof href === 'string' ? href : href.url;
        return (
            currentUrl === targetUrl || currentUrl.startsWith(`${targetUrl}/`)
        );
    };

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

                    {/* Info Struktur & Role Aktif + Tombol Ganti Peran */}
                    {activeAssignment && (
                        <SidebarMenuItem className="mt-1 px-2 group-data-[collapsible=icon]:hidden">
                            <div className="border-sidebar-border bg-sidebar-accent/50 flex items-center justify-between rounded-lg border px-2.5 py-2 text-xs">
                                <div className="min-w-0 flex-1">
                                    <p className="text-sidebar-foreground truncate font-semibold">
                                        {activeAssignment.struktur_organisasi
                                            ?.nama_unit ?? 'Struktur Aktif'}
                                    </p>
                                    <p className="text-muted-foreground truncate text-[11px]">
                                        {activeAssignment.role?.nama_role ??
                                            'Pengurus'}
                                    </p>
                                </div>

                                {hasMultipleAssignments && (
                                    <Link
                                        href="/pilih-struktur?ganti=1"
                                        title="Ganti Struktur / Peran"
                                        className="bg-background hover:bg-accent ml-2 inline-flex shrink-0 items-center gap-1 rounded-md border px-2 py-1 text-[11px] font-medium"
                                    >
                                        <ArrowLeftRight className="h-3 w-3" />
                                        <span>Ganti</span>
                                    </Link>
                                )}
                            </div>
                        </SidebarMenuItem>
                    )}
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <SidebarGroup>
                    <SidebarGroupLabel>Menu Utama</SidebarGroupLabel>
                    <SidebarMenu>
                        {visibleMenus.map((menu) => {
                            // 1. Menu tunggal tanpa sub-menu (misal: Dashboard)
                            if (!menu.items) {
                                return (
                                    <SidebarMenuItem key={menu.title}>
                                        <SidebarMenuButton
                                            asChild
                                            isActive={isPathActive(menu.href)}
                                            tooltip={menu.title}
                                        >
                                            <Link
                                                href={menu.href ?? '#'}
                                                prefetch
                                            >
                                                <menu.icon />
                                                <span>{menu.title}</span>
                                            </Link>
                                        </SidebarMenuButton>
                                    </SidebarMenuItem>
                                );
                            }

                            // 2. Menu dengan sub-menu (Collapsible)
                            const isGroupOpen = menu.items.some((sub) =>
                                isPathActive(sub.href),
                            );

                            return (
                                <Collapsible
                                    key={menu.title}
                                    asChild
                                    defaultOpen={isGroupOpen}
                                    className="group/collapsible"
                                >
                                    <SidebarMenuItem>
                                        <CollapsibleTrigger asChild>
                                            <SidebarMenuButton
                                                tooltip={menu.title}
                                                isActive={isGroupOpen}
                                            >
                                                <menu.icon />
                                                <span>{menu.title}</span>
                                                <ChevronRight className="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                                            </SidebarMenuButton>
                                        </CollapsibleTrigger>
                                        <CollapsibleContent>
                                            <SidebarMenuSub>
                                                {menu.items.map((sub) => (
                                                    <SidebarMenuSubItem
                                                        key={sub.title}
                                                    >
                                                        <SidebarMenuSubButton
                                                            asChild
                                                            isActive={isPathActive(
                                                                sub.href,
                                                            )}
                                                        >
                                                            <Link
                                                                href={sub.href}
                                                                prefetch
                                                            >
                                                                <span>
                                                                    {sub.title}
                                                                </span>
                                                            </Link>
                                                        </SidebarMenuSubButton>
                                                    </SidebarMenuSubItem>
                                                ))}
                                            </SidebarMenuSub>
                                        </CollapsibleContent>
                                    </SidebarMenuItem>
                                </Collapsible>
                            );
                        })}
                    </SidebarMenu>
                </SidebarGroup>
            </SidebarContent>

            <SidebarFooter>
                {/* <NavFooter items={footerNavItems} className="mt-auto" /> */}
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
