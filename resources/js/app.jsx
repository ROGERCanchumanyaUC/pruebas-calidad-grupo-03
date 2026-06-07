import React from "react";
import ReactDOM from "react-dom/client";
import AiChat from "./components/AiChat";

const root = document.getElementById("ai-chat");
if (root) {
    ReactDOM.createRoot(root).render(<AiChat />);
}
