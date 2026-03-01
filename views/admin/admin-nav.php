<?php
/**
 * Admin Navigation Header
 * Shared across all admin pages
 */
?>

<nav class="fixed top-0 left-0 right-0 z-50 border-b border-border bg-black/95 backdrop-blur-xl px-6 py-3">
    <div class="mx-auto max-w-6xl flex items-center justify-between">
        <a href="/admin/dashboard" class="text-sm font-bold tracking-widest text-accent uppercase">
            ⚙ Admin
        </a>
        
        <ul class="flex gap-6 items-center text-sm">
            <li><a href="/admin/dashboard" class="hover:text-accent transition">Dashboard</a></li>
            <li><a href="/admin/case-studies" class="hover:text-accent transition">Case Studies</a></li>
            <li><a href="/admin/services" class="hover:text-accent transition">Services</a></li>
            <li><a href="/admin/inquiries" class="hover:text-accent transition">Inquiries</a></li>
            <li class="border-l border-border/50 pl-6">
                <a href="/" class="hover:text-accent transition">← Back to Site</a>
            </li>
            <li>
                <a href="/admin/logout" class="hover:text-red-400 transition">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="h-16"></div>
