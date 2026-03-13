# Bootstrap 4 to 5 Upgrade Design

**Date:** 2026-01-03
**Scope:** Minimal changes approach - upgrade Bootstrap while maintaining visual appearance and functionality

## Current State

- Bootstrap 4.6.0 installed via npm
- Using Popper.js v1.x (Bootstrap 4 dependency)
- 62 blade template files in resources/views
- Already partially migrated (some files use `data-bs-*` attributes)
- About 15 instances of Bootstrap 4-specific classes (`form-group`)
- jQuery required (used by FullCalendar and toastr plugins)

## Upgrade Approach

The upgrade will be done in 3 phases:

1. **Dependency Update** - Update npm packages (Bootstrap, Popper.js)
2. **Template Migration** - Update all blade files for Bootstrap 5 compatibility
3. **Testing & Verification** - Ensure visual consistency and functionality

## Phase 1: Dependency Changes

### Package Updates

```json
{
  "bootstrap": "^4.6.0" → "^5.3.0",
  "popper.js": "^1.16.1" → REMOVE,
  "@popperjs/core": ADD "^2.11.8",
  "jquery": "^3.6" → KEEP (required for calendar plugin)
}
```

### Rationale

- Bootstrap 5.3 is the latest stable version with long-term support
- Bootstrap 5 requires @popperjs/core v2.x instead of popper.js v1.x
- jQuery must be retained due to FullCalendar and toastr dependencies
- Bootstrap bundle includes Popper.js, so no additional configuration needed

## Phase 2: Template Migration Strategy

### Key Breaking Changes to Address

#### 1. JavaScript Data Attributes (Partially Complete)
- `data-toggle` → `data-bs-toggle`
- `data-target` → `data-bs-target`
- `data-dismiss` → `data-bs-dismiss`
- `data-parent` → `data-bs-parent`

**Status:** Most files already use `data-bs-*` syntax. Need to verify all 62 files are consistent.

#### 2. Form Classes (15 instances)
- `form-group` class is deprecated but still functions in Bootstrap 5
- **Decision:** Keep `form-group` as-is to avoid layout shifts
- This maintains exact visual appearance with minimal changes

#### 3. Input Group Structure
- Check for `input-group-append` or `input-group-prepend`
- If found: Remove wrapper divs, simplify structure
- New structure: direct button/text children of `input-group`

#### 4. Badge Classes
- `badge-primary` → `badge bg-primary`
- `badge-danger` → `badge bg-danger`
- All contextual badge classes require the `bg-*` prefix

#### 5. Custom Components
- Check for `custom-select`, `custom-file`, `custom-control`
- Replace with standard Bootstrap 5 form controls
- Update associated JavaScript if needed

### Migration Approach

1. Use automated search/replace for consistent patterns
2. Manual review of complex components (modals, dropdowns, accordions)
3. Priority order:
   - JavaScript-dependent components first (break functionality)
   - Visual/CSS classes second (affect appearance only)

### Files Requiring Changes

**High Priority (JavaScript-dependent):**
- layouts/app.blade.php (navbar, dropdowns)
- layouts/left-menu.blade.php (collapsible menus)
- classes/index.blade.php (accordions)
- courses/teacher.blade.php (dropdowns)
- components/events/event-calendar.blade.php (modals, toasts)

**Medium Priority (Forms):**
- All auth views (login, register, password reset)
- assignments/create.blade.php
- syllabi/create.blade.php
- Student/teacher add/edit forms

**Low Priority (Display only):**
- List views, profile views, index pages

## Phase 3: Testing & Verification Plan

### Visual Regression Testing

Test key pages before/after upgrade:
- Login page (`/login`)
- Home dashboard (`/home`)
- Student list page
- Course page with dropdowns
- Forms (add student, create assignment)
- Class index with accordions

### Interactive Component Testing

- Navigation dropdowns (user menu, left sidebar)
- Collapsible accordions (class/section listing)
- Modal dialogs
- Toast notifications (event calendar)
- Form validation displays
- Navbar collapse on mobile

### Responsive Testing

- Mobile viewport (navbar collapse/expand)
- Tablet viewport (grid behavior)
- Desktop viewport (full layout)

### Build & Deploy Steps

1. Update package.json dependencies
2. Run `npm install` to install new packages
3. Run `npm run dev` to compile assets
4. Clear browser cache and test at http://localhost:8000
5. Fix any visual issues discovered
6. Run `npm run production` for optimized build
7. Commit changes to git

### Rollback Plan

- Work in a git branch (`dev-bootstrap5` or similar)
- Can revert package.json and run `npm install` if critical issues found
- Compiled assets can be regenerated from Bootstrap 4 if needed
- No database changes required, so rollback is safe

### Success Criteria

- ✅ All pages render without console errors
- ✅ All interactive components function correctly (dropdowns, modals, collapses)
- ✅ Visual appearance matches Bootstrap 4 version
- ✅ Laravel application tests still pass
- ✅ No JavaScript errors in browser console
- ✅ Responsive behavior works on mobile/tablet/desktop
- ✅ Event calendar (toastr/FullCalendar) continues working

## Risk Assessment

**Low Risk:**
- Bootstrap 5 is well-documented and widely adopted
- Most data attributes already migrated
- Minimal template changes required
- jQuery compatibility maintained
- Easy rollback available

**Potential Issues:**
- Third-party CSS overrides may need adjustment
- Custom styles in app.css may conflict with BS5 changes
- Edge cases in complex components may need manual fixes

## Post-Upgrade Maintenance

- Update CLAUDE.md to reflect Bootstrap 5.x usage
- Document any custom workarounds or compatibility fixes
- Consider future removal of jQuery if calendar plugin updates
- Monitor for Bootstrap 5.x security updates
