// Enhanced dropdown functionality
$(document).ready(function() {
    // Initialize DataTable
    if ($.fn.DataTable) {
        $('#myTable').DataTable();
    }
    
    // Enhanced dropdown toggle with animation
    $('.dropdown-toggle').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Get the current dropdown menu
        var currentDropdown = $(this).next('.dropdown-menu');
        
        // Check if this dropdown is already open
        var isOpen = currentDropdown.hasClass('show');
        
        // Close all dropdowns first
        $('.dropdown-menu').removeClass('show');
        
        // If the clicked dropdown wasn't open, open it
        if (!isOpen) {
            currentDropdown.addClass('show');
            
            // Position the dropdown properly to prevent overlapping
            var btnHeight = $(this).outerHeight();
            var windowHeight = $(window).height();
            var dropdownHeight = currentDropdown.outerHeight();
            var btnOffset = $(this).offset().top;
            
            // Check if dropdown would go off screen
            if (btnOffset + btnHeight + dropdownHeight > windowHeight) {
                // Position above the button if it would go off screen
                currentDropdown.css({
                    'top': 'auto',
                    'bottom': '100%',
                    'margin-bottom': '5px',
                    'margin-top': '0'
                });
            } else {
                // Position below the button
                currentDropdown.css({
                    'top': '100%',
                    'bottom': 'auto',
                    'margin-top': '5px',
                    'margin-bottom': '0'
                });
            }
        }
    });
    
    // Close dropdown when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.btn-group').length) {
            $('.dropdown-menu').removeClass('show');
        }
    });
    
    // Add icons to dropdown items if missing
    $('.dropdown-menu li a').each(function() {
        if (!$(this).find('i').length) {
            var text = $(this).text().trim();
            if (text.toLowerCase().includes('map')) {
                $(this).prepend('<i class="fas fa-map-marker-alt"></i> ');
            } else if (text.toLowerCase().includes('edit')) {
                $(this).prepend('<i class="fas fa-edit"></i> ');
            } else if (text.toLowerCase().includes('delete')) {
                $(this).prepend('<i class="fas fa-trash-alt"></i> ');
            } else if (text.toLowerCase().includes('view')) {
                $(this).prepend('<i class="fas fa-eye"></i> ');
            }
        }
    });
});