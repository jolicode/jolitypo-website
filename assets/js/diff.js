import * as Diff from "diff";

export default () => {
    document.addEventListener('DOMContentLoaded', () => {
        const fixedContent = document.querySelector('.js-fixed-content');
        const one = fixedContent.dataset.isToFix;
        const other = fixedContent.dataset.isFixed;

        let span = null;

        const diff = Diff.diffChars(one, other),
        display = document.getElementById('js-display'),
        fragment = document.createDocumentFragment();

        diff.forEach((part) => {
            // green for additions, red for deletions
            // grey for common parts
            const color = part.added ? 'green' :
                part.removed ? 'red' : 'grey';
            span = document.createElement('span');
            span.style.color = color;
            span.appendChild(document.createTextNode(part.value));
            fragment.appendChild(span);
        });

        display.appendChild(fragment);
    })



}
