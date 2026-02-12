/**
 * 1. IMPORTS & CONFIGURATION
 */
import hljs from 'highlight.js/lib/core';
import 'highlight.js/styles/github-dark.css';

// Syntax Highlighting Languages
import bash from 'highlight.js/lib/languages/bash';
import css from 'highlight.js/lib/languages/css';
import xml from 'highlight.js/lib/languages/xml';
import javascript from 'highlight.js/lib/languages/javascript';
import json from 'highlight.js/lib/languages/json';
import markdown from 'highlight.js/lib/languages/markdown';
import php from 'highlight.js/lib/languages/php';
import scss from 'highlight.js/lib/languages/scss';
import yaml from 'highlight.js/lib/languages/yaml';
import python from 'highlight.js/lib/languages/python';
import sql from 'highlight.js/lib/languages/sql';
import typescript from 'highlight.js/lib/languages/typescript';
import turtle from './highlightjs/languages/turtle';

// Registration
const languages = { 
    bash, css, javascript, json, markdown, php, 
    scss, yaml, python, sql, typescript, turtle,
    html: xml 
};
Object.entries(languages).forEach(([name, lang]) => hljs.registerLanguage(name, lang));

// Global exposure
window.hljs = hljs;

/**
 * 2. CORE UTILITIES
 */
const highlightAll = () => {
    document.querySelectorAll('pre code:not(.hljs)').forEach((block) => {
        hljs.highlightElement(block);
    });
};

const updateText = (id, value) => {
    const el = document.getElementById(id);
    if (el) el.textContent = value;
};

/**
 * 3. GLOBAL EVENT LISTENERS (DOM Ready)
 */
document.addEventListener('DOMContentLoaded', () => {
    // A. Initialize Highlighting
    highlightAll();
    const observer = new MutationObserver(highlightAll);
    observer.observe(document.body, { childList: true, subtree: true });

    // B. Auth Status Management
    fetch('/api/user-status')
        .then(res => res.json()) // Added .json() check
        .then(data => {
            if (data.logged_in) {
                ['user-name', 'user-email', 'user-initials'].forEach(key => {
                    updateText(key, data.user[key.split('-')[1]]);
                    updateText(`${key}-mobile`, data.user[key.split('-')[1]]);
                });
                document.querySelectorAll('#auth-user-menu').forEach(m => m.classList.remove('hidden'));
            } else {
                document.querySelectorAll('#guest-login-link').forEach(l => {
                    l.classList.replace('hidden', 'flex');
                });
            }
        }).catch(() => console.log("Auth check skipped."));

    // C. Sidebar Scroll Persistence
    const sidebar = document.getElementById('sidebar');
    if (sidebar) {
        const scrollPos = sessionStorage.getItem('sidebar-scroll');
        if (scrollPos) sidebar.scrollTop = scrollPos;
        sidebar.addEventListener('click', () => {
            sessionStorage.setItem('sidebar-scroll', sidebar.scrollTop);
        });
    }

    // D. Dropdown Logic
    document.querySelectorAll('#user-menu-button').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const dropdown = btn.nextElementSibling;
            if (dropdown?.id === 'user-dropdown') {
                dropdown.classList.toggle('hidden');
            }
        });
    });

    document.addEventListener('click', () => {
        document.querySelectorAll('#user-dropdown').forEach(d => d.classList.add('hidden'));
    });
});

/**
 * 4. WINDOW-SCOPED FUNCTIONS (FOR BLADE)
 */
window.copyCode = function(targetId, btn) {
    const codeElement = document.getElementById(targetId);
    if (!codeElement) return;

    navigator.clipboard.writeText(codeElement.innerText.trim()).then(() => {
        const originalContent = btn.innerHTML;
        
        // Visual feedback
        btn.classList.add('text-emerald-600', 'dark:text-emerald-400');
        // If your button uses an SVG icon, you might just want to change color
        // If it's text, you can change the text.
        
        setTimeout(() => {
            btn.classList.remove('text-emerald-600', 'dark:text-emerald-400');
        }, 2000);
    });
};

window.toggleMobileMenu = function() {
    const menu = document.getElementById('mobile-menu');
    if (!menu) return;
    menu.classList.toggle('hidden');
    document.body.classList.toggle('overflow-hidden');
};