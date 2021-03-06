import TranslationService from "../../services/TranslationService";

const NotificationService = require("../../services/NotificationService");

Vue.component("add-to-compare-listt", {

    props: {
        template: {
            type: String,
            default: "#vue-add-to-compare-list"
        },
        variationId: Number
    },

    data()
    {
        return {
            isLoading: false
        };
    },

    computed:
    {
        isVariationInCompareList()
        {
            return this.compareListIds.includes(this.variationId);
        },

        ...Vuex.mapState({
            compareListIds: state => state.compareList.compareListIds
        })
    },

    watch:
    {
        isVariationInCompareList()
        {
            this.changeTooltipText();
        }
    },

    created()
    {
        this.$options.template = this.template;
    },

    methods:
    {
        switchState()
        {
            if (this.isVariationInCompareList)
            {
                this.removeFromCompareList();
            }
            else
            {
                this.addToCompareList();
            }
        },

        addToCompareList()
        {
            if (!this.isLoading)
            {
                this.isLoading = true;
                this.$store.dispatch("addToCompareList", parseInt(this.variationId)).then(
                    response =>
                    {
                        this.isLoading = false;

                        NotificationService.success(
                            TranslationService.translate("MykitchensCeresTheme::Template.singleItemCompareListAdded")
                        );
                    },
                    error =>
                    {
                        this.isLoading = false;
                    });
            }
        },

        removeFromCompareList()
        {
            if (!this.isLoading)
            {
                this.isLoading = true;
                this.$store.dispatch("removeCompareListItem", {id: parseInt(this.variationId)}).then(response =>
                {
                    this.isLoading = false;

                    NotificationService.success(
                        TranslationService.translate("MykitchensCeresTheme::Template.singleItemCompareListRemoved")
                    );
                },
                error =>
                {
                    this.isLoading = false;
                });
            }
        },

        changeTooltipText()
        {
            const tooltipText = TranslationService.translate(
                "MykitchensCeresTheme::Template." + (this.isVariationInCompareList ? "singleItemCompareListRemove" : "singleItemCompareListAdd")
            );

            $(".add-to-compare-list")
                .attr("data-original-title", tooltipText)
                .tooltip("hide")
                .tooltip("setContent");
        }
    }
});
