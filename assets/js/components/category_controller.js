import { Controller } from "@hotwired/stimulus";
let selectedCategoryId = "";

export default class extends Controller {
    static targets = ["childList", "expand"]; 
    
    connect() {
        if (this.hasChildListTarget) {
            this.childListTarget.style.display = "none";
            this.expandTarget.textContent = "+"; 
        }
    }

    toggle(event) {
        event.preventDefault(); 

        if (this.hasChildListTarget) {
            const isCollapsed = this.childListTarget.style.display === "none";
            this.childListTarget.style.display = isCollapsed ? "block" : "none"; 
            this.expandTarget.textContent = isCollapsed ? "-" : "+"; 
        }
    }

    select(event) {
        const categoryName = event.currentTarget.dataset.categoryName;
        const categoryId = event.currentTarget.dataset.categoryId;

        document.querySelectorAll("[data-action='click->category#select']")
            .forEach((el) => el.classList.remove("bg-gray-200"));
        event.currentTarget.classList.add("bg-gray-200");

        selectedCategoryId = categoryId;
    }

    add() {
        const name = prompt("Enter the name of the new category:");
        if(!name) return;
        fetch("/category/add", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({parentId: selectedCategoryId, name})
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Category added successfully!");
                location.reload();
            } else {
                alert(data.message || "An error occurred.");
            }
        });
    }

    edit() {
        const name = prompt("Enter the new name of the category:");
        if (!name) return;

        fetch("/category/edit", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ categoryId: selectedCategoryId, name })
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Category updated successfully!");
                location.reload();
            } else {
                alert(data.message || "An error occurred.");
            }
        });
    }

    delete() {
        if (!confirm("Are you sure you want to delete this category?")) return;

        fetch("/category/delete", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ categoryId: selectedCategoryId })
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Category deleted successfully!");
                location.reload();
            } else {
                alert(data.message || "An error occurred.");
            }
        });
    }
}