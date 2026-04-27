// source/assets/js/main.js

// 1. Import the shared engine
import { highlightAll } from '../../../source/_shared/js/main.js';

// 2. Local Utility
const updateText = (id, value) => {
    const el = document.getElementById(id);
    if (el) el.textContent = value;
};

document.addEventListener('DOMContentLoaded', () => {
    // A. KeyBase Auth Management
    fetch('/api/user-status')
        .then(res => res.json())
        .then(data => {
            if (data.logged_in) {
                ['user-name', 'user-email', 'user-initials'].forEach(key => {
                    const val = data.user[key.split('-')[1]];
                    updateText(key, val);
                    updateText(`${key}-mobile`, val);
                });
                document.querySelectorAll('#auth-user-menu').forEach(m => m.classList.remove('hidden'));
                document.querySelectorAll('#guest-login-link').forEach(l => l.classList.replace('flex', 'hidden'));
            } else {
                document.querySelectorAll('#guest-login-link').forEach(l => l.classList.replace('hidden', 'flex'));
            }
        }).catch(() => console.log("Auth check skipped (local/guest)."));

    // B. UI Logic (Dropdowns/Sidebar)
    document.querySelectorAll('#user-menu-button').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const dropdown = btn.nextElementSibling;
            if (dropdown?.id === 'user-dropdown') dropdown.classList.toggle('hidden');
        });
    });

    document.addEventListener('click', () => {
        document.querySelectorAll('#user-dropdown').forEach(d => d.classList.add('hidden'));
    });
    
    // C. Sidebar Scroll
    const sidebar = document.getElementById('sidebar');
    if (sidebar) {
        const scrollPos = sessionStorage.getItem('sidebar-scroll');
        if (scrollPos) sidebar.scrollTop = scrollPos;
        sidebar.addEventListener('click', () => {
            sessionStorage.setItem('sidebar-scroll', sidebar.scrollTop);
        });
    }
});